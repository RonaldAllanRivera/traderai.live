<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration {
    public function up(): void
    {
        $this->migrator->add('lead_capture.auto_login_after_signup', false);
        $this->migrator->add('lead_capture.redirect_url_when_auto_login_disabled', 'https://www.vantage-traders.net/');
    }

    public function down(): void
    {
        $this->migrator->delete('lead_capture.auto_login_after_signup');
        $this->migrator->delete('lead_capture.redirect_url_when_auto_login_disabled');
    }
};
