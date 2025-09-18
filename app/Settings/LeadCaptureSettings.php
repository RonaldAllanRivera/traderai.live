<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class LeadCaptureSettings extends Settings
{
    public bool $auto_login_after_signup;

    public string $redirect_url_when_auto_login_disabled;

    public static function group(): string
    {
        return 'lead_capture';
    }
}
