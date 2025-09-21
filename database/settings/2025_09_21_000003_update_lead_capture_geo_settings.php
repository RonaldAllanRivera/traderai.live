<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration {
    public function up(): void
    {
        $this->migrator->add('lead_capture.country_auto_adjust_enabled', true);
        $this->migrator->add('lead_capture.priority_country', 'GB');
    }

    public function down(): void
    {
        $this->migrator->delete('lead_capture.country_auto_adjust_enabled');
        $this->migrator->delete('lead_capture.priority_country');
    }
};
