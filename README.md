# The Immediate Trade Pro — Laravel 12 + Filament 4

Production‑ready Laravel 12 app with a modern Filament 4 admin and a dynamic public landing layer. Admins select the active public template from the panel; the homepage resolves geo/calling code server‑ and client‑side; leads post to the backend with an optional redirect splash. The admin suite includes Leads, Users, Pixels, Cloaker, and Settings, with strong developer ergonomics (seeders, factories, Postman, and deployment playbooks).

**What stands out at a glance**
- Dynamic public templates: pick the active template in Admin → System → Appearance; routes remain static.
- Leads at scale: Leads and Users with search/filtering and streaming CSV export.
- Pixels manager: attach tracking snippets by provider, location, and status.
- Cloaker middleware: rule‑based allow/redirect by IP, country, UA, referrer, and params; includes counters and an admin tester.
- Geo/phone controls: admin‑controlled worldwide auto country code or forced Priority Country, with server‑side libphonenumber validation and client‑side UX.
- Operational maturity: SSH+Git deployment flows, clear env/bootstrap, troubleshooting, and testing guides.

## Table of Contents

- Overview (this section)
- [Tech Stack](#tech-stack)
- [Quick Start (Local)](#quick-start-local)
- [Laragon (Apache) Local Setup (no php artisan serve)](#laragon-apache-local-setup-no-php-artisan-serve)
- [Features](#features)
- [Public Pages (Current)](#public-pages-current)
- [Template Selection (Appearance)](#template-selection-appearance)
- [Template Assets (Migration and Best Practices)](#template-assets-migration-and-best-practices)
- [Local Development](#local-development)
- [Admin Notes](#admin-notes)
- [Testing Tutorial (Step-by-step)](#testing-tutorial-step-by-step)
- [How to Test Cloaker](#how-to-test-cloaker)
- [Deployment (SiteGround SSH + GitHub)](#deployment-siteground-ssh--github)
 - [Deployment (Namecheap cPanel + GitHub, public_html)](#deployment-namecheap-cpanel--github-public_html)
- [Troubleshooting](#troubleshooting)
 - [Troubleshooting Note: 422 with Ofcom test numbers](#troubleshooting-note-422-with-ofcom-test-numbers)
- [Bot Protection (Cloudflare Turnstile)](#bot-protection-cloudflare-turnstile)
- [Changelog](#changelog)
- [License](#license)

## Tech Stack

- Laravel 12 (PHP 8.2+)
- Filament 4 (Livewire v3)
- MySQL / MariaDB

## Quick Start (Local)

1) Install dependencies
```bash
composer install
```
2) Configure environment
```bash
cp .env.example .env
php artisan key:generate
```
3) Migrate and seed (optional)
```bash
php artisan migrate --seed
```
4) Run the app
```bash
php artisan serve
```

### Key URLs
- `http://127.0.0.1:8000/` — Home (dynamic template)
- `http://127.0.0.1:8000/admin` — Filament Admin

## Laragon (Apache) Local Setup (no php artisan serve)

Use Laragon’s Auto Virtual Hosts so Apache serves the app at a local domain without running `php artisan serve`.

1) Run Laragon as Administrator
- Close Laragon, then launch it with “Run as administrator” so it can update the Windows hosts file and vhosts.

2) Enable Auto Virtual Hosts
- Laragon Menu → Preferences → General
- Check “Auto virtual hosts”, set domain suffix to `.test`
- Restart Apache from Laragon Menu → Apache → Restart

3) Ensure hosts entry exists
- In `C:\Windows\System32\drivers\etc\hosts`, add:
```
127.0.0.1 traderai.live.test
```
Laragon usually manages this automatically when running as admin.

4) VirtualHost (if Auto vhosts doesn’t pick up Laravel automatically)
- Create `e:/laragon/etc/apache2/sites-enabled/traderai.live.test.conf` with:
```apache
<VirtualHost *:80>
    ServerName traderai.live.test
    DocumentRoot "E:/laragon/www/traderai.live/public"

    <Directory "E:/laragon/www/traderai.live/public">
        AllowOverride All
        Require all granted
    </Directory>

    ErrorLog  "logs/traderai.live.test-error.log"
    CustomLog "logs/traderai.live.test-access.log" common
</VirtualHost>
```
- Restart Apache from Laragon.

5) Local environment tips
- `.env` should include:
```
APP_ENV=local
APP_DEBUG=true
APP_URL=http://traderai.live.test

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=traderai_live_db
DB_USERNAME=root
DB_PASSWORD=
```
- Build assets once to avoid running Vite dev server:
```
npm install
npm run build
```

Open http://traderai.live.test in your browser.

## Features

- Public Landing Layer (Dynamic Templates)
  - Admin-selectable template under Admin → System → Appearance.
  - Routes stay static; controller renders `"{template}.home|safe|redirect"`.
  - Production-ready static assets; per-template assets recommended under `public/{slug}/`.

- Lead Capture & Redirect Flow
  - Sign-up posts to `POST /leads`; creates a `Lead` and a matching `User` if not existing.
  - Server-side phone validation backed by `giggsey/libphonenumber-for-php`:
    - Accepts MOBILE and FIXED_LINE_OR_MOBILE types only.
    - Enforces the target region (Priority Country when forced, otherwise the selected/detected country).
    - Normalizes to E.164 (split into `phone_prefix` + national `phone_number`).
  - AJAX success returns a redirect URL from settings; UI shows an inline thank-you then navigates to `/redirect` (forwards after ~5s).
  - AJAX errors surface inline with field-level messages (422 shows the first validation error from the server).
  - Optional Cloudflare Turnstile CAPTCHA (server-verified). See: [Bot Protection (Cloudflare Turnstile)](#bot-protection-cloudflare-turnstile)
  - Lead Capture Settings (Admin → System → Lead Capture):
    - Toggle: Auto-login user after signup. Default OFF in this repo; if ON, ensure your app provides a post-login destination.
    - When OFF: redirects to a configurable external URL (default `https://www.vantage-traders.net/`).
    - Geo/Phone: enable worldwide auto country code & flag, or force a Priority Country (locks flag/dial and hides country dropdown).
  - Route `POST /leads` is rate-limited to `20/min` to mitigate abuse.

- Public UX tweaks
  - Homepage CTA title "Discover The Platform!" now links to the configured Redirect URL when auto‑login is disabled (Admin → System → Lead Capture → redirect_url_when_auto_login_disabled). Falls back to `/redirect` if empty.
  - Header language block shows "EN" with a simple dropdown containing “English” that links back to the homepage.

- Admin (Filament 4)
  - Leads: list with search, status badge/filter, and CSV export.
  - Users: list/create/edit with `is_admin` toggle and optional password update.
  - Pixels: list/create/edit pixel snippets with provider, location (`head` / `body_start` / `body_end`), status, and notes. Active pixels are injected into the homepage template by location. The safe page does not include marketing pixels by default.
  - Cloaker: manage whitelist/blacklist rules with presets and counters.
  - Delete actions enabled across all resources (row Delete + Bulk Delete).
  - Cloaker: create rules (whitelist/blacklist) with match types (ip/country/ua/referrer/param), metrics, admin tester with presets and run-on-route buttons.
  - Access control: only users with `is_admin = true` can access `/admin`; non-admins are redirected to `/dashboard`.
  - Admin login includes a “Forgot your password?” link.

### Lead Capture Settings (Geo & Phone)

- Page: Admin → System → Lead Capture (`App\Filament\Pages\LeadCaptureSettingsPage`)
- Settings (`App\Settings\LeadCaptureSettings`)
  - `country_auto_adjust_enabled` (bool):
    - ON: autodetect country (or use selection) and validate against that region.
    - OFF: force `priority_country` and lock the phone widget (hide country dropdown).
  - `priority_country` (ISO2): GB, US, IL, AE supported out of the box.
- Validation
  - Server-side (libphonenumber): requires valid mobile (or fixed_line_or_mobile) for the active region; normalizes to E.164 components.
  - Client-side: basic country-aware regex to give instant feedback; server remains the source of truth.
  - The phone input is `type="tel"` to preserve leading zeros (e.g., UK `07…`).

- Data & Seeders
  - `AdminSeeder` reads `ADMIN_NAME|EMAIL|PASSWORD` from `.env` and promotes the user to admin.
  - `LeadSeeder` seeds 15 realistic leads.
  - `LeadFactory` auto-creates a matching `User` (password: `password`) for each seeded lead.

- Developer Experience
  - Clear route map, environment/bootstrap steps, and testing tutorial.
  - CSV export endpoint streams in chunks for memory efficiency.

- Geo & Phone Auto-Country
  - Server-side resolution on homepage: `ResolveCountryMiddleware` determines the visitor ISO (priority: URL override → CDN header like `CF-IPCountry` → session → IP lookup via ipwho.is with 700ms timeout). Applied only to `/`.
  - Client IP detection for lookup: `CF-Connecting-IP` → `True-Client-IP` → first `X-Forwarded-For` → `X-Real-IP` → `Request::ip()`.
  - Cloaker-driven overrides: `?__country=US` or `?geo=US` propagate and take precedence.
  - Initial render shows the correct flag/dial and notice. Hidden `area_code` (`phone_prefix`) and `country` inputs are pre-seeded server-side.
  - Client-side: phone widget flag/dial auto-syncs via `intl-tel-input` (with fallbacks) and re-enforcement for up to 10s to cover late mounts.
  - Dynamic notice under the phone field updates server-side and client-side: “Currently only [flag sprite] [Country Name] Nationals can register.” Country name uses `Intl.DisplayNames` with a robust fallback map (includes IL → Israel). Dial map expanded (e.g., IL → +972, BE → +32, and other common regions).
  - Middleware preserves overrides on redirect: `CloakerMiddleware` keeps `__country`, `geo`, `__ua`, `__ref`, and common UTM params when redirecting to offer/safe.
  - CDN cache safety: homepage responses include `Vary: CF-IPCountry` when available to avoid cross-country cache bleed on Cloudflare.
  - Session stickiness: resolved geo is cached in session for 60 seconds to balance stability and fast updates.

## Public Pages (Current)

The public site now serves only TraderAI template pages. Legacy public landing/auth pages were removed.

- TraderAI template pages (dynamic)
  - `resources/views/traderai-template/home.blade.php` → `/`
  - `resources/views/traderai-template/safe.blade.php` → `/safe`
  - `resources/views/traderai-template/redirect.blade.php` → `/redirect`
  - Active template is selected in Admin → System → Appearance (Filament), stored in `SiteAppearanceSettings.public_template`.
  - The controller `App\\Http\\Controllers\\PublicPagesController` resolves the current template and renders `"{template}.home"`, `"{template}.safe"`, and `"{template}.redirect"`.
  - Template registry lives in `config/templates.php` to whitelist available template folders and labels.

- Lead submission
  - `POST /leads` handled by `App\Http\Controllers\LeadsController@store`
  - `GET /leads/export` streams CSV; controller checks `Auth::user()->is_admin`

Routes are declared in `routes/web.php`.

## Authentication (Admin only)

- Admin authentication is fully managed by Filament under `/admin/*`.
- Password reset is enabled via `->passwordReset()` in `app/Providers/Filament/AdminPanelProvider.php`.
- Admin login includes a "Forgot your password?" link that opens the Filament forgot-password page.
- Public auth routes (`/login`, `/forgot-password`, `/reset-password`, `/dashboard`) were removed.

## Template Selection (Appearance)

- Admin → System → Appearance provides a dropdown to choose the public template.
- Settings class: `App\\Settings\\SiteAppearanceSettings` (`group(): 'site_appearance'`).
- DB migration: `database/settings/2025_09_19_000002_create_site_appearance_settings.php` seeds default from `config/templates.php`.
- After saving, the page auto-clears compiled views so the change is immediate.

Notes:
- `config/templates.php` now declares supported locales for the TraderAI template:
  ```php
  'traderai-template' => [
      'label' => 'TraderAI',
      'views' => ['home', 'safe', 'redirect'],
      'locales' => ['en','es','fr','de','it','pt','ar','he'],
  ],
  ```
  This registry will be used by the Appearance settings to restrict language choices per template.

Add a new template
- Create `resources/views/{slug}/home.blade.php`, `safe.blade.php`, `redirect.blade.php`.
- Add to `config/templates.php` under `available` with a human label.
- Select it in Admin → System → Appearance.

Notes & best practices
- Keep per-template assets under `public/{slug}/` and include them inside the template blades.
- Maintain consistent view names (home, safe, redirect) across templates to swap seamlessly.
- Routes stay static; only the controller decides which template to render.

## Template Assets (Migration and Best Practices)

This app serves public pages from Blade templates under `resources/views/{slug}/` and expects static assets for each template under `public/{slug}/`.

The active template slug is resolved by `App\Http\Controllers\PublicPagesController`, and the views receive a dynamic `$assetBase` that points to `asset("{slug}/")`. The base tag in each template is:

```blade
<base href="{{ $assetBase }}">
```

### How we migrated assets from `landing-page/`

Goal: move static assets into the public directory so `{{ asset('{slug}/') }}` can serve them directly.

1) Create target folders (PowerShell example)
```powershell
New-Item -ItemType Directory -Force -Path "E:\laragon\www\traderai.live\public\traderai-template\css" | Out-Null
New-Item -ItemType Directory -Force -Path "E:\laragon\www\traderai.live\public\traderai-template\js" | Out-Null
New-Item -ItemType Directory -Force -Path "E:\laragon\www\traderai.live\public\traderai-template\img" | Out-Null
New-Item -ItemType Directory -Force -Path "E:\laragon\www\traderai.live\public\traderai-template\fonts" | Out-Null
New-Item -ItemType Directory -Force -Path "E:\laragon\www\traderai.live\public\traderai-template\other" | Out-Null
New-Item -ItemType Directory -Force -Path "E:\laragon\www\traderai.live\public\traderai-template\video" | Out-Null
New-Item -ItemType Directory -Force -Path "E:\laragon\www\traderai.live\public\traderai-template\css_img" | Out-Null
```

2) Copy assets from the legacy folder (keep subfolder names)
```powershell
robocopy "E:\laragon\www\traderai.live\landing-page\css"     "E:\laragon\www\traderai.live\public\traderai-template\css" /E
robocopy "E:\laragon\www\traderai.live\landing-page\js"      "E:\laragon\www\traderai.live\public\traderai-template\js" /E
robocopy "E:\laragon\www\traderai.live\landing-page\img"     "E:\laragon\www\traderai.live\public\traderai-template\img" /E
robocopy "E:\laragon\www\traderai.live\landing-page\fonts"   "E:\laragon\www\traderai.live\public\traderai-template\fonts" /E
robocopy "E:\laragon\www\traderai.live\landing-page\other"   "E:\laragon\www\traderai.live\public\traderai-template\other" /E
robocopy "E:\laragon\www\traderai.live\landing-page\video"   "E:\laragon\www\traderai.live\public\traderai-template\video" /E
robocopy "E:\laragon\www\traderai.live\landing-page\css_img" "E:\laragon\www\traderai.live\public\traderai-template\css_img" /E
```

3) Do NOT copy `landing-page/index.php`

- `routes/web.php` already preserves old form actions with a server-side redirect:
  ```php
  // Route excerpt
  Route::match(['GET','POST'], '/{template}/index.php', function () {
      return redirect()->to(route('home') . '#req-form-section');
  })->where(['template' => '[A-Za-z0-9\-]+'])->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);
  ```

### Prevent redirect loops on `/traderai-template/`

Some browsers request the base URL directory directly when you set `<base href="/traderai-template/">`. To avoid 301/302 loops under Apache, add an `.htaccess` and a stub index file inside the assets folder:

- File: `public/traderai-template/.htaccess`
  ```apache
  Options -Indexes
  DirectoryIndex index.html
  ```

- File: `public/traderai-template/index.html`
  ```html
  <!doctype html><meta charset="utf-8"><title>assets</title>
  ```

Clear browser cache if a 301 was cached, then reload.

### Dynamic base URL per template (implemented)

- Controller (`App\Http\Controllers\PublicPagesController`):
  - Each of `home()`, `safe()`, `redirect()` computes `$slug` for the selected/fallback template and passes `['assetBase' => asset($slug . '/')]` to the view.
- Views (`resources/views/{slug}/home.blade.php`, `safe.blade.php`):
  - Replace the hardcoded `<base href="{{ asset('traderai-template/') }}/">` with `<base href="{{ $assetBase }}">`.

This lets you add more templates without touching the Blade base URLs.

### Troubleshooting 404s after moving assets

- Check that files exist under `public/{slug}/...` (e.g., `/traderai-template/js/jquery-3.5.1.min.js`).
- Ensure the `<base>` tag is present as the very first resource tag in `<head>`.
- Hard refresh with cache disabled in DevTools.
- If Laravel caches are stale after editing views/config, run:
  ```bash
  php artisan optimize:clear && php artisan optimize
  ```

### How to add a new template

Follow this tutorial to add a new public template that can be selected from Admin → System → Appearance.

1) Create the template views
- Directory: `resources/views/{slug}/`
- Required files:
  - `home.blade.php`
  - `safe.blade.php`
  - `redirect.blade.php`

Example minimal `resources/views/pro-template/home.blade.php`:
```blade
@php(
  // Optional: template-local variables or includes
  $title = 'Trader AI – Pro Template';
)
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <title>{{ $title }}</title>
    {{-- Example per-template CSS --}}
    <link rel="stylesheet" href="/templates/pro-template/style.css">
  </head>
  <body>
    <h1>Welcome to the Pro Template</h1>
    {{-- Your sections/components here --}}
  </body>
  </html>
```

2) (Optional) Add per-template assets
- Place assets under: `public/templates/{slug}/`
- Reference them from your Blade files, e.g.:
```html
<link rel="stylesheet" href="/templates/pro-template/style.css">
<script src="/templates/pro-template/app.js" defer></script>
```

3) Register the template in the registry
- File: `config/templates.php`
- Add an entry under `available`:
```php
'pro-template' => [
    'label' => 'Pro Template',
    'views' => ['home', 'safe', 'redirect'],
],
```

4) Select the template in Admin
- Go to Admin → System → Appearance.
- Choose your new template from the dropdown and Save.
- The page clears compiled views automatically so changes apply immediately.

5) Clear caches if needed
- If you just edited `config/templates.php`, you may need to clear config/opcache:
```bash
php artisan optimize:clear
```

6) Verify
- Visit `/` → should render `resources/views/{slug}/home.blade.php`.
- Visit `/safe` and `/redirect` → should render corresponding views from your selected template.

Fallback behavior
- If a selected template is missing one of the required views, the controller falls back to the default template defined in `config/templates.php` for that page.

Tips
- Keep view names consistent across templates (`home`, `safe`, `redirect`).
- Avoid referencing global CSS/JS from templates; prefer per-template assets to prevent style bleed.

Route notes
- `/` (homepage) uses `resolve.country` + `CloakerMiddleware`.
- `/safe` does not use `resolve.country` by design; it remains a static safe page without marketing pixels.

### Pixels (Tracking)

- Admin-managed via: Admin → Marketing → Pixels.
- Each pixel has: `provider`, `status`, `location` (head, body_start, body_end), and raw `code`.
- Injection:
  - Homepage (`resources/views/traderai-template/home.blade.php`) renders all `status=active` pixels by their `location`.
  - Safe page (`resources/views/traderai-template/safe.blade.php`) intentionally does NOT inject marketing pixels by default.
- Best practices:
  - Load vendor snippets async/defer when possible to protect Core Web Vitals.
  - Avoid duplicate initializations per platform; centralize conversion events.
  - Consider consent gating in regulated regions (GDPR/CCPA) before firing marketing pixels.

## Authentication (Admin only)

- Admin login and password reset are handled entirely by Filament under `/admin/*`.
- Public login/dashboard routes have been removed in this repo to focus on a pure lead-capture → redirect flow.

## Local Development

1. Install dependencies
```
composer install
```

2. Environment
```
cp .env.example .env
php artisan key:generate
```
Update DB credentials in `.env`.

3. Migrate database
```
php artisan migrate
```

If you encounter a collation error on `password_reset_tokens` with older MySQL/MariaDB, set your DB to utf8mb4 (MySQL 5.7+/MariaDB 10.3+) or adjust the migration to limit string length (191).

4. Create an admin user (option A: seed)
```
cp .env.example .env
# Set these in .env before seeding:
# ADMIN_NAME="Admin"
# ADMIN_EMAIL="admin@example.com"
# ADMIN_PASSWORD="changeme123"
php artisan db:seed --class=Database\\Seeders\\AdminSeeder
```

Or create an admin user (option B: wizard)
```
php artisan make:filament-user
```
Follow the prompts. This uses the default `users` table/`web` guard. Then promote to admin (if needed):
```
php artisan tinker
>>> App\Models\User::where('email', 'admin@example.com')->update(['is_admin' => true]);
```

5. Seed demo leads (optional)
```
php artisan db:seed --class=Database\\Seeders\\LeadSeeder
```

6. Run the app
```
php artisan serve
```
Open:

- `http://127.0.0.1:8000/` — Public homepage (dynamic template)
- `http://127.0.0.1:8000/admin` — Filament Admin

## Admin Notes

- Filament uses the default `web` guard and `App\Models\User`.
- Admin access is restricted:
  - `App\Models\User::canAccessPanel()` only allows users with `is_admin = true`.
  - Middleware `App\Http\Middleware\EnsureAdmin` redirects non-admin authenticated users away from `/admin/*` to `/dashboard`.
- Admin login page includes a “Forgot your password?” link that uses the same reset flow as public users.
- Roadmap: migrate to a dedicated Admin guard + model when needed.

## Admin Password Reset

- Admin forgot/reset pages are provided by Filament:
  - `/admin/forgot-password` (GET/POST)
  - `/admin/reset-password` (GET/POST)
  - Ensure mail is configured in `.env` for reset emails.

## Seeding

- Initial admin: `php artisan db:seed --class=Database\\Seeders\\AdminSeeder`
- Demo leads (15 records): `php artisan db:seed --class=Database\\Seeders\\LeadSeeder`
- All seeders: `php artisan db:seed`

Notes:
- Demo volume is configurable via `LEAD_COUNT` in `.env`. Defaults to 5 in production, 15 otherwise.
  - Example: `LEAD_COUNT=5`
- If seeding feels slow on shared hosting, temporarily lower `BCRYPT_ROUNDS` (e.g., `10`) and restore later if desired.

## Testing Tutorial (Step-by-step)

1) Public signup → dashboard
   - Visit `/sign-up`, fill fields (simple password allowed or click “Generate passwords”).
   - Submit; you’ll be redirected to `/dashboard` and a `Lead` + `User` will be created.

2) Public login/logout
   - Visit `/login`, enter your credentials.
   - Menus update: hides “Sign Up”, shows a POST “Logout” button, header banner shows “Hello, {name}”.

3) Admin access (allowed only for admins)
   - Create admin via seeder or promote an existing user’s `is_admin` to true.
   - Visit `/admin` and sign in. Non-admins are redirected to `/`.

4) Leads management (Filament)
   - Visit `/admin/leads` as an admin to see all leads (seeded or collected via signup form).

5) Forgot/reset password
   - Visit `/forgot-password`, request a reset link (configure Mail in `.env`).
   - Use the emailed token to open `/reset-password/{token}` and set a new password.

6) Change password (authenticated)
   - Visit `/settings/password` and submit current + new password.

7) Export leads as CSV (admin)
   - Visit `/admin/leads` as an admin.
   - Click the `Export CSV` header action; a streamed CSV download will open in a new tab.

8) Cloaker quick test (admin)
   - Visit Filament → Marketing → `Cloaker` and click `Test Cloaker`.
   - Use `Use Rule` to select a rule or a shortcut preset, then Submit. See detailed steps in the next section.

## How to Test Cloaker

The cloaker is active on `/` and `/sign-up` via `App\Http\Middleware\CloakerMiddleware`.
By default, when a blacklist rule matches, users are redirected to `route('safe')` which points to `resources/views/traderai-template/safe.blade.php`.

- Admin-side tester (recommended)
  - In Filament: Marketing → Cloaker → click `Test Cloaker` in the header.
  - Use Rule: select any active rule (e.g., "Blacklist Google Reviewers"). The form auto-fills a matching test. You can still tweak values.
  - Shortcut Preset: `Normal User`, `Google Reviewers`, `Facebook Reviewers`, or `Custom`.
  - Fields: choose IP, Country (ISO 2), User Agent, Referrer; add Query Params as Key/Value. Custom fields appear when needed.
  - Submit: see the decision (SAFE/OFFER/allow) and the matched rule name.
  - Run on actual route: the notification includes buttons to open `/` and `/sign-up` in new tabs. These links include testing overrides: `__ua`, `__ref`, `__country` so the middleware can simulate those values.
  - Use `Reset Counters` to zero `hits_safe` / `hits_offer` across all rules.

- Postman testing (also available)
  - Import the ready-made collection: `docs/postman/CloakerTests.postman_collection.json` and set `baseUrl` if needed.
  - Requests included (redirects disabled per request):
    - Home / Sign-up — Google Reviewers (UA)
    - Home / Sign-up — Facebook Reviewers (UA + Referrer)
    - Home / Sign-up — Country header example (SG via CF-IPCountry)
    - Home / Sign-up — Param Match (utm_source)
  - Tips:
    - Turn OFF "Automatically follow redirects" globally to always see `302 Location` (optional; per-request is already disabled).
    - You can add `__country=XX` as a query param if you’re not behind Cloudflare.
  - Results:
    - With redirects OFF: expect `302` with `Location: /safe` or `Location: /`.
    - With redirects ON: Postman follows to the final page content (Safe or Offer).

- Counters and visibility
  - Each redirect increments `hits_safe` or `hits_offer` on the matched rule.
  - Open any rule in Filament to see the counters; use `Reset Counters` to clear.

- Quick toggle
  - You can disable the cloaker globally by adding `CLOAKING_ENABLED=false` in `.env` and (optionally) referencing it in `config/app.php`:
  ```php
  // config/app.php
  'cloaking_enabled' => env('CLOAKING_ENABLED', true),
  ```

### Geo & Phone Override Test

1) From Filament → Marketing → `Cloaker` → `Test Cloaker`, choose a country and click “Run on route /”.
2) Expected on `/` (`resources/views/traderai-template/home.blade.php`):
   - The phone input shows the corresponding flag and dial (e.g., `+1` for US) within ~0–2 seconds (enforced up to 10s).
   - The notice under the phone field reads: “Currently only [flag sprite] [Country Name] Nationals can register.”
3) Try switching to SG/PH/GB. The flag (CSS sprite) and dial update accordingly; hidden `area_code` pre-seeds server-side.
4) If a cloaker redirect occurs, the override is preserved by middleware so the view receives it.

Advanced notes:
- Overrides honored: `__country` (ISO2) and `geo` (ISO2). If absent, `meta[name="isoCode"]` fallback is used, else IP lookup.
- The phone widget integration tries `intlTelInputGlobals`, then `window.intlTelInput`, then `jQuery.fn.intlTelInput`, and finally a DOM fallback.
- Enforcement re-applies desired state for up to 10 seconds to cover late mounting.

Troubleshooting:
- Hard refresh with DevTools open if assets are cached.
 - If country seems “sticky”, wait 60 seconds or use `?__country=XX` override; ensure CDN honors `Vary: CF-IPCountry`.

UI consistency:
- The notice flag uses the same CSS sprite family as the phone widget: `<span class="iti__flag iti__{iso}"></span>`.


## Deployment (Namecheap cPanel + GitHub, public_html)

This project is set up to work on Namecheap shared hosting where you cannot change the document root. We will clone directly into `public_html` and use a root `.htaccess` to forward traffic to `public/`.

1) Enable SSH and add your GitHub key
- In Namecheap cPanel: enable SSH and generate an SSH key (or upload your existing public key).
- Add that public key to GitHub (Deploy key on the repo, or to your GitHub account) so you can use the SSH clone URL.

2) First-time deploy (clone into public_html)
```bash
# SSH into your Namecheap account
ssh USER@SERVER

cd ~/public_html
git clone --depth 1 git@github.com:YOUR_USER/YOUR_REPO.git .

# Environment
cp .env.example .env
sed -i 's|APP_URL=.*|APP_URL=https://YOUR_DOMAIN|' .env   # adjust for your domain
nano .env   # set DB_*, MAIL_*, etc.

# Install & optimize
composer install --no-dev --optimize-autoloader
php artisan key:generate --force
php artisan storage:link
php artisan migrate --force --seed   # remove --seed if not desired
php artisan optimize

# Ensure root .htaccess forwards to /public and blocks sensitive files
test -f .htaccess && echo "Root .htaccess found" || echo "Create .htaccess from README sample below"
```

3) Subsequent updates (pull latest changes)
```bash
ssh USER@SERVER
cd ~/public_html
git pull --rebase
composer install --no-dev --optimize-autoloader
php artisan migrate --force
php artisan optimize
```

4) Optional: cPanel Git Version Control (push-to-deploy)
- Create a cPanel repository (bare or working copy) under your home directory.
- It will show a remote like: `ssh://USER@SERVER:PORT/home/USER/repositories/your-repo.git`
- Add it as a remote locally and push:
```bash
git remote add namecheap ssh://USER@SERVER:PORT/home/USER/repositories/your-repo.git
git push -u namecheap main
```
- Use cPanel’s Deploy button or a post-receive hook to update `public_html`.

5) Root `.htaccess` (required when cloning into public_html)
Example:
```apache
<IfModule mod_rewrite.c>
  RewriteEngine On
  # send everything to /public
  RewriteCond %{REQUEST_URI} !^/public/
  RewriteRule ^(.*)$ public/$1 [L,QSA]
</IfModule>

# extra hardening (deny direct access to sensitive files)
<FilesMatch "^(\.env|artisan|composer\.(json|lock)|package\.json|webpack\.mix\.js|vite\.config\.js)$">
  Require all denied
</FilesMatch>
```

7) File permissions (shared hosting defaults)
```bash
find storage -type d -exec chmod 775 {} \;
find storage -type f -exec chmod 664 {} \;
chmod -R 775 bootstrap/cache
```

8) Updating to a new version
```bash
# Option A
cd ~/apps/trading-site
# Option B
# cd ~/www/ARTWORKDOMAIN.COM/public_html

git pull --rebase
composer install --no-dev --optimize-autoloader
php artisan migrate --force
php artisan optimize
```

Option B.2 — In-place Git (non-empty `public_html`, keep backups like `old-root-backup/`)
First-time GitHub SSH on this server will ask to trust the host; answer `yes`. Verify auth:
```bash
ssh -T git@github.com   # expect a success message (no shell access provided)
```
```bash
# WARNING: this will overwrite local changes. Backup first.
cd ~/www/ARTWORKDOMAIN.COM/public_html

# Backup
tar -czf ../public_html_backup_$(date +%Y%m%d_%H%M%S).tar.gz .

# If a .git already exists and points elsewhere, remove it
rm -rf .git

# Initialize and attach your GitHub repo
git init
git remote add origin https://github.com/RonaldAllanRivera/traderai.live.git
git fetch --depth 1 origin main
git reset --hard origin/main

# Keep backup folders out of git status (local exclude)
echo "old-root-backup/" >> .git/info/exclude

# Install and optimize
composer install --no-dev --optimize-autoloader
php artisan key:generate --force
php artisan storage:link
php artisan migrate --force --seed   # remove --seed if not desired
php artisan optimize
```


## Troubleshooting

- Seeding slow or appears stuck
  - Cause: bcrypt hashing for generated users; shared hosting can be slow at higher costs.
  - Fixes:
    - Reduce demo volume: set `LEAD_COUNT=5` (default in production) and run only the leads seeder.
    - Temporarily set `BCRYPT_ROUNDS=10`, seed, then restore.
    - Seed specific classes: `php artisan db:seed --class=Database\\Seeders\\AdminSeeder --force`.
- Composer not found
  - Try absolute path: `/usr/local/bin/composer install --no-dev --optimize-autoloader`.
- Permission denied writing to storage
  - Run: `find storage -type d -exec chmod 775 {} \\; && find storage -type f -exec chmod 664 {} \\; && chmod -R 775 bootstrap/cache`.
- GitHub SSH Permission denied (publickey)
  - Generate SSH key on server, add to GitHub Deploy keys, and test with `ssh -T git@github.com`.
- HTTP 500 after deploy
  - Check `storage/logs/laravel.log`; verify `.env` DB credentials; ensure `.htaccess` rewrites to `/public`.

- 422 on `/leads` (valid-looking but still rejected)
  - Ensure the number matches the active country. In forced‑GB mode, PH/US formats will fail.
  - Ofcom drama/test numbers (e.g., `07700 900123`) are treated as non‑assignable by libphonenumber and will fail.
  - Don’t type `+44` inside the input; the UI already supplies the prefix via a hidden field.

- CAPTCHA always fails
  - Verify keys and domain at Cloudflare → Turnstile. Use the right site/secret pair and ensure `TURNSTILE_ENABLED=true`.
  - The widget auto-posts a hidden `cf-turnstile-response`. Make sure the widget renders (no ad/script blockers during testing).
  - Check server logs for errors if 422 persists.

## Bot Protection (Cloudflare Turnstile)

Turnstile is integrated on the public lead form and verified server-side when enabled.

0) Create a Turnstile widget and add your domains
- Go to https://dash.cloudflare.com → Turnstile → Add widget
- Widget name: any descriptive label (e.g., TraderAI Lead Form)
- Hostnames: add each host you will use (no protocol or paths):
  - traderai.live
  - traderai.live.test
  - localhost
  - 127.0.0.1
  - app.traderai.live (if you use a subdomain)
- Widget mode: Managed (recommended). You can switch to Invisible later.
- Pre-clearance: No (unless you specifically need a site-wide Cloudflare challenge bypass cookie)
- Save and copy the generated Site key and Secret key.

1) Configure environment
```
TURNSTILE_ENABLED=true
TURNSTILE_SITE_KEY=1x00000000000000000000AA   # replace with your site key
TURNSTILE_SECRET_KEY=1x0000000000000000000000000000000AA  # replace with your secret
TURNSTILE_TIMEOUT=5
```

2) Code paths
- Config: `config/services.php` → `services.turnstile.*`
- Blade widget: `resources/views/traderai-template/home.blade.php` (auto-includes API script and renders widget when enabled)
- Verification: `App\Http\Controllers\LeadsController@store` validates `cf-turnstile-response` via Cloudflare’s `siteverify` endpoint

3) Testing
- With valid keys, the widget appears below the phone input. Submit the form; if CAPTCHA is missing/invalid, you’ll see an inline error and a reset of the widget.
- To disable locally, set `TURNSTILE_ENABLED=false` and clear caches: `php artisan optimize:clear`.

- Filament delete action classes not found
  - Ensure Filament v4 subpackages are installed and autoloaded:
    - `composer require filament/tables:^4 filament/actions:^4 filament/forms:^4 filament/support:^4`
  - In v4, row/bulk actions come from `Filament\\Actions`, not `Filament\\Tables\\Actions`.
  - Clear caches: `composer dump-autoload -o && php artisan optimize:clear`.

## Changelog

### 2025-09-18
- Cloaker middleware now preserves query params (`__country`, `geo`, `geo_debug`, `__ua`, `__ref`, `utm_*`, `gclid`, `fbclid`) when redirecting to offer/safe.
- Homepage geo/phone integration:
  - Server-side meta `isoCode` and hidden `area_code` pre-seeded from `__country|geo` (default `PH`).
  - Client-side phone flag/dial sync with robust fallbacks and 10s enforcement.
  - `geo_debug=1` green overlay (server-rendered) for quick verification.
  - Dynamic registration notice wired to the same override, using the CSS sprite flag for Chrome-safe rendering.

## License

MIT
