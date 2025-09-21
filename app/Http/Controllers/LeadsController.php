<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use App\Models\User;
use App\Settings\LeadCaptureSettings;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Symfony\Component\HttpFoundation\Response;
use libphonenumber\PhoneNumberUtil;
use libphonenumber\PhoneNumberFormat;
use libphonenumber\PhoneNumberType;
use libphonenumber\NumberParseException;

class LeadsController extends Controller
{
    public function store(Request $request): Response
    {
        /** @var LeadCaptureSettings $settings */
        $settings = app(LeadCaptureSettings::class);
        $region = strtoupper(
            ($settings->country_auto_adjust_enabled ?? true)
                ? ($request->input('country') ?: 'GB')
                : ($settings->priority_country ?? 'GB')
        );

        $util = PhoneNumberUtil::getInstance();

        // Friendly country name + example per region for validation messages
        $countryNames = [
            'GB' => 'United Kingdom',
            'US' => 'United States',
            'IL' => 'Israel',
            'AE' => 'United Arab Emirates',
        ];
        $examples = [
            'GB' => '07123 456789',
            'US' => '(201) 555-0123',
            'IL' => '050-123-4567',
            'AE' => '050 123 4567',
        ];
        $prettyName = $countryNames[$region] ?? $region;
        $example = $examples[$region] ?? 'mobile number';
        $errMsg = 'Please enter a valid mobile number for ' . $prettyName . ' (e.g., ' . $example . ').';

        $validated = $request->validate([
            'first_name'   => ['nullable', 'string', 'max:256'],
            'last_name'    => ['nullable', 'string', 'max:256'],
            'email'        => ['required', 'email', 'max:256'],
            'country'      => ['nullable', 'string', 'max:256'],
            'phone_prefix' => ['nullable', 'string', 'max:64'],
            'password'     => ['nullable', 'string', 'max:255'],
            // Cloudflare Turnstile CAPTCHA (if enabled)
            'cf-turnstile-response' => [
                'nullable',
                function (string $attribute, mixed $value, \Closure $fail) use ($request) {
                    if (! config('services.turnstile.enabled')) {
                        return; // skip when disabled
                    }
                    if (! $value) {
                        return $fail('Please verify that you are human.');
                    }
                    try {
                        $resp = Http::asForm()
                            ->timeout((int) config('services.turnstile.timeout', 5))
                            ->post('https://challenges.cloudflare.com/turnstile/v0/siteverify', [
                                'secret'   => (string) config('services.turnstile.secret_key'),
                                'response' => (string) $value,
                                'remoteip' => (string) $request->ip(),
                            ]);
                        $ok = $resp->ok();
                        $data = $ok ? $resp->json() : null;
                        if (! $ok || ! ($data['success'] ?? false)) {
                            return $fail('CAPTCHA verification failed. Please try again.');
                        }
                    } catch (\Throwable $e) {
                        return $fail('CAPTCHA verification failed. Please try again.');
                    }
                },
            ],
            'phone_number' => [
                'required', 'string', 'max:64',
                function (string $attribute, mixed $value, \Closure $fail) use ($util, $region, $request, $errMsg) {
                    try {
                        $raw = (string) $value;
                        $digits = preg_replace('/\D+/', '', $raw);
                        $prefix = preg_replace('/\D+/', '', (string) $request->input('phone_prefix', ''));
                        if ($prefix !== '') {
                            // Build E.164 candidate using prefix + national (strip leading zeros from national part)
                            $candidate = '+' . $prefix . ltrim($digits, '0');
                            $proto = $util->parse($candidate, null);
                        } else {
                            $proto = $util->parse($raw, $region);
                        }
                        if (! $util->isPossibleNumber($proto) || ! $util->isValidNumber($proto)) {
                            return $fail($errMsg);
                        }
                        // Ensure the number region matches the campaign region (GB, etc.)
                        $protoRegion = $util->getRegionCodeForNumber($proto);
                        if (! $protoRegion || strtoupper($protoRegion) !== strtoupper($region)) {
                            return $fail($errMsg);
                        }
                        $type = $util->getNumberType($proto);
                        if (! in_array($type, [PhoneNumberType::MOBILE, PhoneNumberType::FIXED_LINE_OR_MOBILE], true)) {
                            return $fail($errMsg);
                        }
                    } catch (NumberParseException $e) {
                        return $fail($errMsg);
                    }
                },
            ],
        ]);

        $passwordEncrypted = null;
        if (!empty($validated['password'])) {
            $passwordEncrypted = Crypt::encryptString($validated['password']);
        }

        // Normalize phone number using libphonenumber (prefer E.164 from prefix + number)
        try {
            $raw = (string) ($validated['phone_number'] ?? '');
            $digits = preg_replace('/\D+/', '', $raw);
            $prefix = preg_replace('/\D+/', '', (string) ($validated['phone_prefix'] ?? ''));
            if ($prefix !== '') {
                $candidate = '+' . $prefix . ltrim($digits, '0');
                $proto = $util->parse($candidate, null);
            } else {
                $proto = $util->parse($raw, $region);
            }
            $normalizedDial = (string) $proto->getCountryCode();
            $normalizedNational = $util->getNationalSignificantNumber($proto);
            $normalizedIso = $region;
        } catch (\Throwable $e) {
            // Fallback to submitted values (should not happen due to validation)
            $normalizedDial = $validated['phone_prefix'] ?? null;
            $normalizedNational = $validated['phone_number'] ?? null;
            $normalizedIso = $validated['country'] ?? $region;
        }

        $lead = Lead::create([
            'first_name'        => $validated['first_name'] ?? null,
            'last_name'         => $validated['last_name'] ?? null,
            'email'             => $validated['email'],
            'country'           => $normalizedIso,
            'phone_prefix'      => $normalizedDial,
            'phone_number'      => $normalizedNational,
            'password_encrypted'=> $passwordEncrypted,
            'status'            => 'new',
        ]);

        // Create or find a matching user account for public dashboard access
        $user = User::firstOrCreate(
            ['email' => $validated['email']],
            [
                'name' => trim(($validated['first_name'] ?? '') . ' ' . ($validated['last_name'] ?? '')) ?: $validated['email'],
                'password' => $validated['password'] ?? Str::random(12),
                'is_admin' => false,
            ]
        );

        // If user existed and a new password was provided, optionally update it
        if (!empty($validated['password']) && $user->wasRecentlyCreated === false) {
            $user->password = $validated['password'];
            $user->save();
        }

        // Determine post-signup behavior from settings
        /** @var LeadCaptureSettings $settings */
        $settings = app(LeadCaptureSettings::class);

        // If the request is AJAX / wants JSON (fetch), return success payload with redirect URL from settings
        $acceptsJson = ($request->ajax() || $request->wantsJson() || str_contains(strtolower((string)$request->header('Accept')), 'application/json'));
        if ($acceptsJson) {
            $target = $settings->redirect_url_when_auto_login_disabled; // dynamic from DB settings
            return response()->json([
                'status'   => 'ok',
                'redirect' => $target,
                'lead_id'  => $lead->id,
            ]);
        }

        if ($settings->auto_login_after_signup ?? false) {
            Auth::login($user);
            return redirect()->route('dashboard')->with('success', 'Thanks! Your account was created and you are now signed in.');
        }

        $target = trim((string) $settings->redirect_url_when_auto_login_disabled); // dynamic from DB settings
        if ($target !== '' && filter_var($target, FILTER_VALIDATE_URL)) {
            return redirect()->away($target);
        }
        // Safe fallback if setting is empty/invalid
        return redirect()->to('/')->with('success', 'Thanks! We have received your details.');
    }

    public function exportCsv(): StreamedResponse
    {
        // Ensure only admins can export
        abort_unless(Auth::check() && (Auth::user()->is_admin ?? false), 403);

        $fileName = 'leads-' . now()->format('Ymd-His') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
            'Cache-Control' => 'no-store, no-cache',
        ];

        return response()->stream(function () {
            $handle = fopen('php://output', 'w');

            // CSV header
            fputcsv($handle, [
                'ID', 'First Name', 'Last Name', 'Email', 'Country',
                'Phone Prefix', 'Phone Number', 'Status', 'Created At',
            ]);

            Lead::orderBy('id')->chunk(500, function ($chunk) use ($handle) {
                foreach ($chunk as $lead) {
                    fputcsv($handle, [
                        $lead->id,
                        $lead->first_name,
                        $lead->last_name,
                        $lead->email,
                        $lead->country,
                        $lead->phone_prefix,
                        $lead->phone_number,
                        $lead->status,
                        optional($lead->created_at)->toDateTimeString(),
                    ]);
                }
            });

            fclose($handle);
        }, 200, $headers);
    }
}
