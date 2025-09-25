# Full-Stack Laravel 12 Application: Modular Frontend with Advanced Marketing & Lead Gen Tools

This repository showcases a production-ready Laravel 12 application built with a modern, modular architecture. It features a powerful Filament 4 admin panel that controls a dynamic, multi-template frontend, designed for high-performance lead generation and sophisticated traffic management.

The system is engineered for scalability and flexibility, allowing administrators to swap out the entire public-facing website from a dropdown in the admin panel, without any code changes. It includes a suite of enterprise-grade marketing tools, robust security features, and a clear path for deployment and maintenance.

**Core Technical Highlights & Features:**

*   **Dynamic Multi-Template Frontend**: A modular architecture where the entire public website (Blade templates and assets) can be switched on-the-fly from the admin panel. This allows for rapid A/B testing and rebranding without redeployment.
*   **Advanced Lead Management System**:
    *   Robust lead capture forms with server-side validation using `giggsey/libphonenumber-for-php` for global phone number accuracy.
    *   Seamless AJAX form submission with a clean redirect flow and inline validation messages.
    *   Integrated CSV export for leads, optimized for large datasets with streaming downloads.
*   **Sophisticated Geo-Targeting & Phone Logic**:
    *   Server-side country resolution middleware that detects a visitor's location via CDN headers (e.g., Cloudflare's `CF-IPCountry`) or IP lookup APIs.
    *   Admin-controlled "Priority Country" mode to force a specific country's dialing code and validation rules on the frontend.
    *   Client-side integration with `intl-tel-input` that syncs automatically with the backend's resolved country.
*   **Enterprise-Grade Marketing & Traffic Management Suite**:
    *   **Cloaker Middleware**: A powerful, custom-built middleware to conditionally redirect traffic based on a rules engine. Rules can target IP address, country, user agent, referrer, or URL parameters, with hit counters for each rule. Includes an admin-panel tester for easy configuration.
    *   **Dynamic Pixel Manager**: An admin-managed system to inject any third-party tracking script (e.g., Google Analytics, Meta Pixel) into the website's `<head>` or `<body>` without touching code.
*   **Modern Admin Panel with Filament 4**: A beautiful and fast admin interface built with the latest version of Filament, providing full CRUD management for all system resources.
*   **Robust Security-First Design**:
    *   **Content Security Policy (CSP)**: Implemented via middleware, with stricter policies for public routes and more permissive rules for the admin panel to accommodate Livewire.
    *   **Bot Protection**: Integrated with Cloudflare Turnstile to secure forms from automated abuse.
    *   **Rate Limiting**: Applied to critical routes like lead submission to prevent spam.
*   **Developer Ergonomics & Operational Maturity**:
    *   Comprehensive documentation covering local setup (Laragon, `php artisan serve`), deployment playbooks (SSH/Git, cPanel), and troubleshooting.
    *   Database seeders and factories for rapid environment setup and testing.

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
- [Security (Content Security Policy)](#security-content-security-policy)
- [New Template Integration Workflow](#new-template-integration-workflow)


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

The public site supports multiple admin-selectable templates. Legacy public landing/auth pages were removed.

- Available templates
  - TraderAI (slug: `traderai-template`)
    - `resources/views/traderai-template/home.blade.php` → `/`
    - `resources/views/traderai-template/safe.blade.php` → `/safe`
    - `resources/views/traderai-template/redirect.blade.php` → `/redirect`
  - FXDTradingAI (slug: `fxdtradingai-template`)
    - `resources/views/fxdtradingai-template/home.blade.php` → `/`
    - `resources/views/fxdtradingai-template/safe.blade.php` → `/safe`
    - `resources/views/fxdtradingai-template/redirect.blade.php` → `/redirect`
  - Active template is selected in Admin → System → Appearance (Filament), stored in `SiteAppearanceSettings.public_template`.
  - The controller `App\\Http\\Controllers\\PublicPagesController` resolves the current template and renders `"{template}.home"`, `"{template}.safe"`, and `"{template}.redirect"`.
  - Template registry lives in `config/templates.php` to whitelist available template folders and labels.

- Lead submission
  - `POST /leads` handled by `App\Http\Controllers\LeadsController@store`
  - `GET /leads/export` streams CSV; controller checks `Auth::user()->is_admin`

Routes are declared in `routes/web.php`.

### Template Notes: FXDTradingAI

- Phone field
  - The legacy country `<select>` has been removed. The phone widget is now driven solely by `intl-tel-input` on the `phone_number` field with `separateDialCode` enabled.
  - Hidden inputs `phone_prefix` and `country` stay synchronized with the selected country. Server validation keeps building E.164 from these values.
  - When Lead Capture Settings force a Priority Country, the widget is locked to that ISO and users cannot change the flag/dial.
  - To change behavior: Admin → System → Lead Capture → toggle Auto Country Adjust or set Priority Country.

- Restored sections
  - Re-added content removed during Blade conversion: "As Easy As 1.2.3" steps, sidebar (share + related), comments block, footer, and bottom scripts (menu toggle, newsletter stub, smooth scroll, SweetAlert message handler, Turnstile, and Meta Pixel).
  - These live in `resources/views/fxdtradingai-template/home.blade.php` and mirror the original static `index.html`.
  - The comments section includes a temporary, client-side comment system using `localStorage`. Comments are added instantly, persist on refresh, and expire after 24 hours.
  - Sidebar share buttons now use platform share URLs (Facebook, X/Twitter, LinkedIn) with encoded metadata.
  - The template sets Open Graph tags in the `<head>` so Facebook/LinkedIn crawlers pull the headline, teaser, and hero image from server-rendered markup. (Platforms no longer allow pre-filled post bodies via share links).

## Add a New Public Template: Implementation Checklist

Use `resources/views/traderai-template/home.blade.php` as the reference for structure and behavior. New templates should follow the same conventions so they can be swapped via Admin → System → Appearance.

- **Register the template**
  - Add your slug and optional label/locales to `config/templates.php`.
  - Ensure `App\Http\Controllers\PublicPagesController` will resolve to your view names: `"{template}.home"`, `"{template}.safe"`, `"{template}.redirect"`.

- **Views to create**
  - `resources/views/{slug}/home.blade.php` (primary landing with form)
  - `resources/views/{slug}/safe.blade.php` (safe variant; no marketing pixels by default)
  - `resources/views/{slug}/redirect.blade.php` (short splash with spinner/message; then forwards to external URL)

- **Assets placement**
  - Put static assets under `public/{slug}/` (img, js, css, video).
  - In the controller, we pass `$assetBase = asset($slug . '/')` and every template must include `<base href="{{ $assetBase }}">` so all relative assets resolve.
  - Optional: a folder-level `public/{slug}/.htaccess` with `Options -Indexes` and (if accessing the folder directly) `DirectoryIndex index.html`.

- **Head setup**
  - Add `<base href="{{ $assetBase }}">`.
  - Compute geo and settings:
    - Resolve ISO and dial code using the middleware-provided attributes or fallbacks, and Lead Capture Settings for forced-country mode.
    - Expose `<meta name="isoCode" content="{{ $computedIso }}">` and `<meta name="forceCountry" content="{{ $forceCountry ? '1' : '0' }}">`.
  - Inject Admin Pixels (head):
    - Loop active pixels where `location = 'head'` exactly like TraderAI.

- **Body start injection**
  - Inject Admin Pixels (body_start) right after `<body>`.
  - Keep the Safe page free of marketing pixels by default.

- **Lead form and phone widget**
  - Use a single phone input managed by `intl-tel-input` (CDN) with `separateDialCode: true`.
  - Remove any legacy country dropdowns.
  - Keep hidden fields synchronized: `phone_prefix` (calling code) and `country` (ISO2).
  - Respect forced-country mode from Lead Capture Settings by locking the picker to the priority country.
  - Show a concise country notice with flag and pretty name (see TraderAI/FXDTradingAI for examples).
  - Flag display uses a hybrid approach: CSS sprite-based flags with SVG fallback for guaranteed display.
  - Includes comprehensive flag sprite positioning for all supported countries with proper CDN hosting.
  - Enhanced flag initialization ensures correct flag appears on page load regardless of timing issues.

- **Cloudflare Turnstile (CAPTCHA)**
  - Gate the widget on config: `@if(config('services.turnstile.enabled') && config('services.turnstile.site_key'))`.
  - Markup: `<div class="cf-turnstile" data-sitekey="{{ config('services.turnstile.site_key') }}"></div>`.
  - Loader: `<script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>` gated by the same condition.
  - On server 422 errors, call `turnstile.reset()` and display the mapped message for `cf-turnstile-response`.

- **AJAX submit (preferred)**
  - Post to `route('leads.store')` with `Accept: application/json` and `X-Requested-With: XMLHttpRequest`.
  - Map server 422 errors to fields (`email`, `phone_number`/`phone`, and `cf-turnstile-response`).
  - On success: show a short thank-you and redirect to the internal `/redirect` splash with `?to=<external>&s=5&lead_id=...`.
  - Throttling and validation are already applied server-side (`LeadsController@store`).

- **Pixels injection (body_end)**
  - Inject Admin Pixels (body_end) just before `</body>`.
  - Do not hardcode tracking scripts in the template. Add them via Admin → Marketing → Pixels.

- **CSP compatibility**
  - Public CSP is enforced in `App\Http\Middleware\SetCspHeaders`.
  - Prefer existing allowlists only. If you introduce new third-party scripts, update the CSP middleware accordingly (script-src/connect-src/frame-src as needed).
  - For Cloudflare Turnstile, we already allow `https://challenges.cloudflare.com` (script/frame/connect). For LiveCoinWatch, we allow `*.livecoinwatch.com` (used by TraderAI ticker); remove if not used.

- **Testing checklist**
  - Geo/Phone: verify ISO flag and dial sync; try `?__country=GB` or `?geo=US` overrides.
  - Forced-country: toggle in Admin → System → Lead Capture; ensure the picker locks to the priority country.
  - CAPTCHA: ensure the widget renders; on empty submit, server returns 422 mapped to the captcha message; Turnstile resets properly.
  - AJAX 422: wrong email/phone show inline errors; Back button flows (if applicable) work.
  - Redirect: after success, `/redirect` shows splash then forwards to settings URL.
  - Pixels: toggle a pixel on/off and verify injection at `head/body_start/body_end` locations.
  - CSP: open DevTools → Console; confirm no CSP blocks. If blocked, adjust the middleware for only the domains you actually use.

- **Config and env**
  - `config/services.php` → `turnstile.site_key` and `turnstile.secret` + `turnstile.enabled`.
  - Seed Admin or login and set `System → Appearance` template selection and `System → Lead Capture` options.
  - Clear caches when needed: `php artisan optimize:clear`.

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

## Security (Content Security Policy)

This project enforces Content Security Policy (CSP) via a Laravel middleware for robust, conditional control instead of static Apache rules.

- Implementation
  - Middleware: `app/Http/Middleware/SetCspHeaders.php`.
  - Registration: globally appended in `bootstrap/app.php` using `$middleware->append(App\Http\Middleware\SetCspHeaders::class)`.
  - Admin detection: prefers `routeIs('filament.admin.*')` (Filament 4 panel id `admin`), with a fallback check for the `admin` path prefix.
  - Apache: `public/.htaccess` no longer sets CSP headers.

- Policies
  - Admin routes (Filament panel `admin`): allows `'unsafe-eval'` in `script-src` to support Livewire/Alpine where needed.
  - Public routes: stricter CSP without `'unsafe-eval'`.

- How to test
  1) Visit a public page like `/`.
     - In DevTools → Network → select the document → Headers, confirm `Content-Security-Policy` exists and `script-src` does NOT include `'unsafe-eval'`.
  2) Visit `/admin/login` (or any Filament admin page).
     - Confirm `Content-Security-Policy` exists and `script-src` DOES include `'unsafe-eval'`.
  3) If you update the middleware, clear caches:
     ```bash
     php artisan optimize:clear
     ```

- Adjustments
  - To allow new vendors/domains, edit the allowlists inside `SetCspHeaders` under each policy block.
  - If you rename the Filament panel id from `admin`, update the route pattern in `isAdminRoute()` accordingly (e.g., `filament.backoffice.*`).

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

### Cloaker URL Configuration

The cloaker URLs are now environment-aware and use the `APP_URL` from your `.env` file to generate correct URLs for each environment.

- **Local Development**: Uses `APP_URL=http://traderai.live.test` (or your local URL)
- **Production**: Uses `APP_URL=https://traderai.live`

#### URL Generation
- Cloaker rules are seeded using `config('app.url')` instead of hardcoded URLs
- This ensures that test links and redirects always use the correct base URL for the current environment
- Example URLs generated:
  - Local: `http://traderai.live.test/safe?__ua=Googlebot`
  - Production: `https://traderai.live/safe?__ua=Googlebot`

#### Applying URL Updates
If you need to update existing cloak rules with the correct URLs:

```bash
# Re-seed cloak rules to use current APP_URL
php artisan db:seed --class=Database\Seeders\CloakRuleSeeder
```

This will update all cloak rule `safe_url` and `offer_url` fields to use the current `APP_URL` configuration.

### Geo & Phone Override Test

1) From Filament → Marketing → `Cloaker` → `Test Cloaker`, choose a country and click "Run on route /".
2) Expected on `/` (`resources/views/traderai-template/home.blade.php`):
   - The phone input shows the corresponding flag and dial (e.g., `+1` for US) within ~0–2 seconds (enforced up to 10s).
   - The notice under the phone field reads: "Currently only [flag sprite] [Country Name] Nationals can register."
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

### 🚀 Quick Start: New Clean Deployment Tutorial

This tutorial is for **fresh installations** on empty domains or when you want to completely replace existing content.

#### Step 1: SSH into Your Namecheap Account
```bash
ssh USER@SERVER
```

#### Step 2: Backup and Clean public_html (Optional but Recommended)
```bash
# Backup existing files (if any)
mv public_html public_html_backup_$(date +%Y%m%d_%H%M%S)

# Create fresh public_html directory
mkdir public_html
cd public_html
```

#### Step 3: Set Up SSH Keys (One-time Setup)
```bash
# Generate SSH key (press Enter for defaults)
ssh-keygen -t ed25519 -C "your_email@example.com"

# Start SSH agent
eval "$(ssh-agent -s)"

# Add key to SSH agent
ssh-add ~/.ssh/id_ed25519

# Copy public key to clipboard
cat ~/.ssh/id_ed25519.pub
```

**Now add the copied public key to GitHub:**
1. Go to GitHub → Settings → SSH and GPG keys
2. Click "New SSH key"
3. Paste the public key and give it a descriptive name
4. Click "Add SSH key"

#### Step 4: Test SSH Connection
```bash
ssh -T git@github.com
```
You should see: "Hi RonaldAllanRivera! You've successfully authenticated..."

#### Step 5: Clone the Repository
```bash
cd ~/public_html
git clone --depth 1 git@github.com:RonaldAllanRivera/traderai.live.git .
```

#### Step 6: Configure Environment
```bash
# Copy environment file
cp .env.example .env

# Set your domain
sed -i 's|APP_URL=.*|APP_URL=https://YOUR_DOMAIN|' .env

# Edit environment file
nano .env
```
**Set these values in `.env`:**
- `APP_NAME=YourAppName`
- `APP_ENV=production`
- `APP_DEBUG=false`
- `DB_DATABASE=your_database_name`
- `DB_USERNAME=your_database_user`
- `DB_PASSWORD=your_database_password`
- `MAIL_*` settings for email

#### Step 7: Install Dependencies and Optimize
```bash
# Install PHP dependencies
composer install --no-dev --optimize-autoloader

# Generate application key
php artisan key:generate --force

# Create storage link
php artisan storage:link

# Run migrations
php artisan migrate --force

# Run seeders (optional)
php artisan db:seed --force

# Clear and cache configurations
php artisan config:clear
php artisan config:cache
php artisan route:clear
php artisan route:cache
php artisan view:clear
php artisan view:cache
```

#### Step 8: Set File Permissions
```bash
# Set proper permissions
chmod -R 755 storage
chmod -R 755 bootstrap/cache
chown -R USER:USER .  # Replace USER with your cPanel username
```

#### Step 9: Verify Deployment
```bash
# Check Laravel installation
php artisan --version

# Test routes
php artisan route:list
```

**Your application should now be live at your domain!** 🎉

---

### Important: Deploying to Non-Empty public_html

### Important: Deploying to Non-Empty public_html
**If your `public_html` directory is not empty** (e.g., existing website, default files), you have two options:

**Option A: Clean Deploy (Recommended for Fresh Install)**
- Backup existing files: `mv public_html public_html_backup`
- Create fresh directory: `mkdir public_html`
- Proceed with steps below

**Option B: Merge Deploy (For Existing Sites)**
- Navigate to public_html: `cd ~/public_html`
- Remove conflicting files/folders manually, then use `git init` and `git pull` instead of clone
- Not recommended due to potential file conflicts

1) Enable SSH and add your GitHub key
- In Namecheap cPanel: enable SSH and generate an SSH key (or upload your existing public key).
- Add that public key to GitHub (Deploy key on the repo, or to your GitHub account) so you can use the SSH clone URL.

2) First-time deploy (clone into public_html)

**For EMPTY public_html (Fresh Install):**
```bash
# SSH into your Namecheap account
ssh USER@SERVER

cd ~/public_html
git clone --depth 1 git@github.com:RonaldAllanRivera/traderai.live.git .
```

**For NON-EMPTY public_html (Existing Files):**
```bash
# SSH into your Namecheap account
ssh USER@SERVER

# Option A: Clean Deploy (Recommended)
mv public_html public_html_backup
mkdir public_html
cd public_html
git clone --depth 1 git@github.com:RonaldAllanRivera/traderai.live.git .

# Option B: Merge Deploy (Advanced)
cd ~/public_html
# WARNING: Manually remove conflicting files/folders first
git init
git remote add origin git@github.com:RonaldAllanRivera/traderai.live.git

# IMPORTANT: Verify SSH connection before pulling
ssh -T git@github.com
# If you see "Permission denied (publickey)", you need to set up SSH keys:
# 1. Generate SSH key: ssh-keygen -t ed25519 -C "your_email@example.com"
# 2. Start SSH agent: eval "$(ssh-agent -s)"
# 3. Add key: ssh-add ~/.ssh/id_ed25519
# 4. Copy public key: cat ~/.ssh/id_ed25519.pub
# 5. Add to GitHub: Settings → SSH and GPG keys → New SSH key
# 6. Test again: ssh -T git@github.com

# After SSH is working, pull the repository
git pull origin main --force  # This may overwrite existing files!
```

**Alternative: Use HTTPS (No SSH Keys Required)**
```bash
cd ~/public_html
git init
git remote add origin https://github.com/RonaldAllanRivera/traderai.live.git
git pull origin main --force
# You'll be prompted for GitHub username and personal access token
```

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

### Fixing "no tracking information" errors when pulling

If your remote repository uses a `main` branch but the server checkout is still on `master`, run the following commands once on that server:

```bash
# 1. Ensure working tree is clean (commit/stash anything pending)
git status -sb

# 2. Rename local branch from master -> main
git branch -m master main

# 3. Fetch latest refs from origin
git fetch origin

# 4. Link local main to origin/main for future pulls
git branch --set-upstream-to=origin/main

# 5. Pull latest changes with rebase
git pull --rebase
```

Need a one-off pull without renaming? Run `git pull --rebase origin main` instead. Renaming and setting upstream is recommended so future `git pull --rebase` calls work without extra arguments.

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

## New Template Integration Workflow

This guide provides a step-by-step workflow for cloning a static HTML template and fully integrating it into the Laravel application, including lead capture, backend logic, and marketing scripts.

### Phase 1: Template Scaffolding & Asset Migration

This phase focuses on converting the raw HTML files into Blade templates and organizing the static assets.

1.  **Clone Static Pages**:
    *   Obtain the static HTML for the primary landing page (`index.html`).
    *   Obtain static HTML for legal pages: `privacy-policy.html`, `terms-and-conditions.html`, and `cookies.html` if available.

2.  **Convert to Blade**:
    *   Rename each `.html` file to `.blade.php`. For example, `index.html` becomes `home.blade.php`.
    *   **Important**: For this workflow, do not use Blade partials (`@include`, `@extends`). Each Blade file should be a self-contained template to match the original structure.

3.  **Organize Files**:
    *   Create a new directory for your template under `public/`, e.g., `public/new-template/`.
    *   Move all static assets (`css`, `js`, `img`, `fonts`, `video`) into this new directory.
    *   Create a corresponding directory under `resources/views/`, e.g., `resources/views/new-template/`.
    *   Move your newly created `.blade.php` files into this view directory.

    *Reference: See the [Template Assets](#template-assets-migration-and-best-practices) section for more details on the asset structure.*

### Phase 2: Lead Form & Backend Integration

This phase connects the public-facing lead form to the application's backend.

1.  **Develop the Lead Form**:
    *   Ensure the form exists in your `home.blade.php` file with fields for at least `email` and `phone_number`.
    *   The form should `POST` to `route('leads.store')`.

2.  **Implement Phone & Email Validation**:
    *   The backend already handles email validation (`required`, `email`, `max:255`).
    *   Phone number validation is based on the selected or priority country. The `LeadsController` uses `libphonenumber` to ensure it's a valid mobile number for that region.

3.  **Connect to Database**:
    *   The `LeadsController@store` method handles creating a `Lead` record upon successful validation. No extra database connection work is needed in the template.

4.  **Set Country Code Logic**:
    *   The phone input widget (`intl-tel-input`) automatically handles country code detection based on the visitor's IP or forced Priority Country.
    *   This is configured in **Admin → System → Lead Capture**. Ensure "Auto Country Adjust" is enabled or a "Priority Country" is set.

### Phase 3: User Flow & Authentication

This phase handles what happens after a user signs up.

1.  **Implement Auto-Login (If Applicable)**:
    *   If the lead form includes `email` and `password` fields, the system can automatically log the user in.
    *   This is controlled in **Admin → System → Lead Capture** → `auto_login_after_signup`.
    *   If enabled, ensure your application has a dashboard or member's area for the user to land on.

2.  **Create Sign-Up Page (If Separate)**:
    *   If the design includes a dedicated `/sign-up` page, clone its HTML, convert it to `signup.blade.php`, and ensure its form also posts to `route('leads.store')`.

### Phase 4: Post-Submission & Redirects

This phase defines the user experience immediately after form submission.

1.  **Display "Thank You" Message**:
    *   Upon successful AJAX submission, your form's JavaScript should display an inline "Thank you" message to the user.

2.  **Implement Redirect Flow**:
    *   After showing the thank you note, the JavaScript should redirect the user to the internal `/redirect` page.
    *   The `redirect.blade.php` template (e.g., `resources/views/fxdtradingai-template/redirect.blade.php`) will be displayed.
    *   This page shows a message and automatically redirects to the external "Redirect URL" (set in **Admin → System → Lead Capture**) after a 5-second delay.
    *   Add a manual link on this page pointing to the same external URL as a fallback.

### Phase 5: Marketing & Tracking

This phase integrates third-party tracking scripts.

1.  **Implement Pixel & Cloaker Scripts**:
    *   **Pixels**: Do not hardcode tracking scripts. Add them via **Admin → Marketing → Pixels**. They will be injected automatically into the `home.blade.php` file at the specified locations (`head`, `body_start`, `body_end`).
    *   **Cloaker**: The `CloakerMiddleware` is already active on the homepage route. It will automatically show the `safe.blade.php` page to visitors who match a blacklist rule. No template changes are required.

### Phase 6: UI/UX & Functionality Enhancements

This phase covers final touches and feature parity with the original static template.

1.  **Modify Logo**:
    *   Edit the logo image file in `public/{template}/img/` to add any required text like "by Vintage Trader".

2.  **Add Links**:
    *   If the design has a title or CTA that should link to the final redirect URL, add an `<a>` tag pointing to the URL configured in **Admin → System → Lead Capture**.

3.  **Implement Social Buttons & Other Features**:
    *   Convert static social media buttons into functional `<a>` tags pointing to share URLs (e.g., `https://www.facebook.com/sharer/sharer.php?u=...`).
    *   Ensure all other interactive elements from the original template are functional.

4.  **Implement Client-Side Commenting**:
    *   If the template includes a comment section, use JavaScript and `localStorage` to create a temporary, client-side commenting system.
    *   New comments should be added to `localStorage` and rendered instantly. They should persist on page refresh but do not need to be saved to the database.


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

Lead forms include Cloudflare Turnstile to prevent automated submissions. The widget appears on the second step (phone number) of the multi-step signup flow.

### Configuration

1. **Cloudflare Turnstile Setup**
   - Create a site key and secret at [Cloudflare Turnstile Dashboard](https://dash.cloudflare.com/?to=/:account/turnstile)
   - Choose "Managed" challenge type for best balance of security and UX
   - Add your development/production domains to the allowed domains list

2. **Environment Variables**
   ```bash
   TURNSTILE_ENABLED=true
   TURNSTILE_SITE_KEY=1x0000000000000000000000000000000AA  # replace with your site key
   TURNSTILE_SECRET_KEY=1x0000000000000000000000000000000AA  # replace with your secret
   TURNSTILE_TIMEOUT=5
   ```

3. **Code paths**
   - Frontend: `resources/views/{template}/home.blade.php` includes the Turnstile widget
   - Backend: `App\Http\Requests\LeadRequest` validates the Turnstile token
   - Validation: Token is verified with Cloudflare's API before lead processing

### Implementation Details

- **Explicit Rendering**: Turnstile uses explicit rendering (`render=explicit`) to prevent automatic initialization issues
- **Conditional Display**: Widget is only rendered when the phone section becomes visible (step 2 of signup)
- **Error Handling**: Includes proper error logging and graceful fallbacks
- **Widget Management**: Automatically resets on back button navigation for clean retry experience
- **Container Cleanup**: Clears existing content before each render to prevent conflicts

### Console Messages

- You may see informational messages like `Note that 'script-src' was not explicitly set, so 'default-src' is used as a fallback` from Turnstile's internal iframe contexts
- These messages are normal and don't affect functionality - they come from Cloudflare's own iframes, not your main page
- Focus on actual functionality: if users can complete challenges successfully, the system is working correctly

### Testing
- With valid keys, the widget appears below the phone input. Submit the form; if CAPTCHA is missing/invalid, you'll see an inline error and a reset of the widget.
- To disable locally, set `TURNSTILE_ENABLED=false` and clear caches: `php artisan optimize:clear`.
  - Ensure Filament v4 subpackages are installed and autoloaded:
    - `composer require filament/tables:^4 filament/actions:^4 filament/forms:^4 filament/support:^4`
  - In v4, row/bulk actions come from `Filament\\Actions`, not `Filament\\Tables\\Actions`.
  - Clear caches: `composer dump-autoload -o && php artisan optimize:clear`.