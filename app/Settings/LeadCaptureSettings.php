<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class LeadCaptureSettings extends Settings
{
    public bool $auto_login_after_signup;

    public string $redirect_url_when_auto_login_disabled;

    // When true, homepage auto-adjusts country code & flag from geo/middleware
    public bool $country_auto_adjust_enabled;

    // When auto-adjust is disabled, use this ISO2 (e.g., GB, US, IL, AE)
    public string $priority_country;

    public static function group(): string
    {
        return 'lead_capture';
    }
}
