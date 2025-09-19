## [0.3.6] - 2025-09-19

### Changed
- Public signup now submits via AJAX and, on success, shows a centered thank‑you message under the form and redirects after ~5 seconds.
- Redirect URL is sourced dynamically from Lead Capture settings only (no frontend hardcoded fallback).

### Fixed
- Controller `LeadsController@store` now reliably returns JSON for AJAX requests (`ajax()`/`wantsJson()`/`Accept` header check) to avoid fetch parsing errors.
- Added validation and a safe fallback when the settings redirect URL is empty/invalid to prevent 500s.

## [0.3.5] - 2025-09-18

### Added
- Cloaker middleware now preserves query params (`__country`, `geo`, `geo_debug`, `__ua`, `__ref`, `utm_*`, `gclid`, `fbclid`) when redirecting to offer/safe.
- Homepage geo/phone integration:
  - Server-side `meta[name="isoCode"]` and hidden `area_code` pre-seeded from `__country|geo` (default `PH`).
  - Client-side phone flag/dial sync with robust fallbacks (intl-tel-input globals/vanilla/jQuery) and 10s enforcement.
  - `geo_debug=1` green overlay (server-rendered) for quick verification.
  - Dynamic registration notice wired to the same override, using CSS sprite flag for Chrome-safe rendering.
- Lead Capture Settings (Admin → System → Lead Capture):
  - Toggle to auto-login user after signup (default OFF in this repo).
  - Configurable external redirect URL when auto-login is disabled (default `https://www.vantage-traders.net/`).
  - Backed by Spatie Laravel Settings; base `settings` table migration added.
- Documentation updates in README:
  - New “Geo & Phone Auto-Country” feature section.
  - New “Geo & Phone Override Test (no console)” steps in How to Test Cloaker.
  - Added Changelog section and ToC entry.

### Fixed
- Chrome flag rendering in the registration notice by switching from emoji to the `iti__{iso}` CSS sprite.
- Filament v4 actions namespace: switched row/bulk delete to `Filament\\Actions` to resolve class-not-found errors.

### Removed
- `geo_debug` overlay and console traces; testing is visual-only (no overlay and no console logs).

### Admin
- Delete actions enabled across all Filament resources (Leads, Pixels, Cloaker Rules, Users): row Delete and Bulk Delete.

### Public UX
- Added lightweight client-side validation on the homepage signup form:
  - Email regex with debounced live checks (200ms) and green check icons.
  - Phone validation intentionally lenient (accepts 6–14 digits) to maximize conversions; inline errors shown on blur/submit.
- Input invalid state updated from tomato to brand-friendly amber (`#ffcc33`).

## [0.3.4] - 2025-09-14

### Fixed
- Routes: explicitly support GET and HEAD for `/` and `/sign-up` to avoid `MethodNotAllowedHttpException` seen on production hosts.

### Added
- AdminSeeder: seed an additional admin account `Admin Tester <admin@gmail.com>` with password `123456` (hashed via model cast).

### Changed
- Deployment docs: clarified Option B (clone to `public_html`) and Option B.2 (in-place Git) with a clean root `.htaccess` sample and first-time GitHub SSH trust note.
- .env.example: populated SiteGround-friendly production defaults and added `ADMIN_*`, `CLOAKING_ENABLED`.

## [0.3.3] - 2025-09-14

### Changed
- README restructured for clarity and best practices:
  - Added Table of Contents, Quick Start (Local), Key URLs, and Troubleshooting anchors.
  - Refined Cloaker testing documentation and alignment with admin tester and Postman collection.
  - Deployment section expanded for SiteGround SSH + GitHub with two options:
    - Option A: app outside `public_html` with docroot/symlink to `public/` (recommended).
    - Option B: clone directly into `public_html` with root `.htaccess` hardening (quick).
  - Added quick-start for artworkwebsite.com and an alternative to convert existing `public_html` into a Git working copy.

# Changelog

All notable changes to this project will be documented in this file.

## [0.3.2] - 2025-09-14

### Added
- Cloaker middleware `App\\Http\\Middleware\\CloakerMiddleware` evaluating active rules (ip/country/ua/referrer/param) and redirecting to Safe/Offer.
- Admin tester enhancements in `CloakRuleResource` → `ListCloakRules`:
  - "Use Rule" selector to auto-fill tests from DB rules.
  - Shortcut presets: Normal User, Google Reviewers, Facebook Reviewers.
  - Live-run buttons open `/` and `/sign-up` with overrides (`__ua`, `__ref`, `__country`).

### Changed
- Prevent redirect loops in cloaker by skipping redirects when destination equals current URL.
- Tester decision logic aligned with middleware (act only on matched rule; whitelist=offer, blacklist=safe).
- Renamed seeder rule to `Blacklist Google Reviewers` for clarity.
- README updated with refined cloaker testing (admin tester flow + Postman tutorial). Postman collection names clarified.

### Fixed
- Fieldset component removed from Filament form to match version support.
- Added tester overrides so new-tab runs simulate UA/Referrer/Country.

## [0.3.1] - 2025-09-13

### Added
- Filament admin
  - CSV export for Leads (streams, chunked) and header action (opens in new tab).
  - UserResource (list/create/edit) with `is_admin` toggle and optional password update.
- Seeders & factories
  - LeadFactory now auto-creates a matching [User](cci:2://file:///e:/laragon/www/the-immediate-trade-pro/app/Models/User.php:11:0-56:1) (password: `password`) for each seeded `Lead`.
- Public UX
  - Signup form improvements: simple passwords, generator button, show/hide toggle, tooltip.
  - Header “Hello, {name}” banner + “Go to Dashboard”.
  - Auth-aware menus: hide Sign Up; switch Login→Logout.
  - Admin login “Forgot your password?” link.

### Changed
- Export route moved to `/leads/export` (outside `/admin`) to avoid route shadowing.
- README expanded with Features, setup, seeding, and testing tutorial.

### Fixed
- Guard `password_reset_tokens` migration to prevent duplicate-table errors on refresh/fresh.

## [0.3.0] - 2025-09-13

### Added
- Public authentication and dashboard
  - Signup → `POST /leads` creates a `Lead` + `User`, logs in, redirects to `/dashboard`.
  - Login (`POST /login`), Logout (`POST /logout`).
  - Forgot/Reset password: `/forgot-password`, `/reset-password/{token}` + pages.
  - Change password: `/settings/password` + controller actions.
- Filament admin
  - Leads resource (list/edit) with status select and filter.
  - Export Leads as CSV via header action (streams, chunked) → `GET /leads/export`.
  - Users resource (list/create/edit) with `is_admin` toggle and optional password update.
  - Admin login page includes a "Forgot your password?" link via render hook.
- Access control
  - Only `is_admin = true` can access `/admin` (via `User::canAccessPanel()` and `EnsureAdmin` middleware).
- Seeders & factories
  - `AdminSeeder` reads `ADMIN_NAME|EMAIL|PASSWORD` from `.env` and promotes to admin.
  - `LeadSeeder` seeds 15 demo leads.
  - `LeadFactory` auto-creates a matching `User` (password: `password`) for each seeded `Lead`.

### Changed
- Landing header and menus are auth-aware (hide Sign Up, switch Login→Logout).
- Signup form UX improved: simple password allowed, generator button, show/hide toggle, tooltip.
- README expanded with Features, setup, seeding, and testing tutorial.

### Fixed
- Filament v4 compatibility (enum property types, form signature, removed unavailable components/actions).
- Prevent duplicate `password_reset_tokens` table creation in migration.

## [0.2.0] - 2025-09-13

### Added
- Implemented public landing pages as Blade views under `resources/views/landing/`.
- Created modular includes to mirror `landing-pages/includes/`:
  - `landing/includes/head.blade.php`, `header.blade.php`, `nav-desktop.blade.php`, `nav-mobile.blade.php`, `sticky.blade.php`, `footer.blade.php`, `scripts.blade.php`.
  - Forms: `form-signup.blade.php`, `form-login.blade.php`.
  - Homepage content: `landing/includes/main.blade.php`.
- Added public pages:
  - `/` → `landing.home`
  - `/login` → `landing.login`
  - `/sign-up` → `landing.sign-up`
  - `/privacy` → `landing.privacy`
  - `/terms` → `landing.terms`
  - `/cookie` → `landing.cookie`
- Added legal content partials under `resources/views/landing/pages/`.

### Changed
- Refactored layout `resources/views/layouts/landing.blade.php` to include new modular includes and match the static HTML structure.
- Updated `routes/web.php` to register routes for public pages.
- Updated `README.md` with landing pages structure, routes, and next steps.

### Notes
- Static assets are served from `public/landing-pages/` and referenced via `asset()`.
- Legacy partials under `resources/views/partials/` are no longer used by public pages.

## [0.1.0] - 2025-09-12

### Added
- Installed Laravel 12 application skeleton.
- Installed Filament 4 for the admin panel.
- Configured Filament to use the default `web` guard and `users` table.
- Documented local setup, admin creation without seeders, and deployment notes in README.

### Removed
- Previously generated custom admin resources and their database tables (Leads, Pixels, Pixel Events, Cloaking Rules, Traffic Logs) to keep the codebase clean.
- Custom `admins` guard/model and related migrations.

### Changed
- Cleaned configuration and caches.

### Notes
- Admin is working at `/admin` using users created via `php artisan make:filament-user`.
