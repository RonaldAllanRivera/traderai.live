<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class SiteAppearanceSettings extends Settings
{
    public string $public_template;

    public static function group(): string
    {
        return 'site_appearance';
    }
}
