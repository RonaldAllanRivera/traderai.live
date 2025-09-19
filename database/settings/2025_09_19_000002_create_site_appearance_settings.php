<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration {
    public function up(): void
    {
        $default = config('templates.default', 'traderai-template');
        $this->migrator->add('site_appearance.public_template', $default);
    }

    public function down(): void
    {
        $this->migrator->delete('site_appearance.public_template');
    }
};
