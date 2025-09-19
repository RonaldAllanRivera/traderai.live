<?php

namespace App\Filament\Pages;

use App\Settings\SiteAppearanceSettings;
use Filament\Forms;
use Filament\Pages\SettingsPage;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Artisan;

class SiteAppearanceSettingsPage extends SettingsPage
{
    protected static string $settings = SiteAppearanceSettings::class;

    protected static \BackedEnum|string|null $navigationIcon = 'heroicon-o-paint-brush';

    protected static \UnitEnum|string|null $navigationGroup = 'System';

    protected static ?string $navigationLabel = 'Appearance';

    protected static ?int $navigationSort = 98;

    public function form(Schema $schema): Schema
    {
        $templates = collect(config('templates.available', []))
            ->mapWithKeys(fn ($meta, $key) => [$key => $meta['label'] ?? $key])
            ->all();

        return $schema->schema([
            Forms\Components\Select::make('public_template')
                ->label('Public Template')
                ->options($templates)
                ->default(config('templates.default'))
                ->required()
                ->rules([
                    // Ensure selection is one of the whitelisted templates
                    'in:' . implode(',', array_keys(config('templates.available', []))),
                ])
                ->native(false)
                ->helperText('Select which template folder under resources/views/{template}/ should be used for public pages (home, safe, redirect). Default: ' . (string) config('templates.default')),
        ]);
    }

    protected function afterSave(): void
    {
        // Clear compiled views so template switch applies immediately
        try { Artisan::call('view:clear'); } catch (\Throwable $e) { /* ignore */ }
    }
}
