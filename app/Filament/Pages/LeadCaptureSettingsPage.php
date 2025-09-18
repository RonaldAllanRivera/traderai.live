<?php

namespace App\Filament\Pages;

use App\Settings\LeadCaptureSettings;
use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Pages\SettingsPage;

class LeadCaptureSettingsPage extends SettingsPage
{
    protected static string $settings = LeadCaptureSettings::class;

    protected static \BackedEnum|string|null $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static \UnitEnum|string|null $navigationGroup = 'System';

    protected static ?string $navigationLabel = 'Lead Capture';

    protected static ?int $navigationSort = 99;

    public function form(Schema $schema): Schema
    {
        return $schema->schema([
            Forms\Components\Toggle::make('auto_login_after_signup')
                ->label('Auto-login user after signup')
                ->default(false)
                ->helperText('If enabled, new users will be signed in and sent to the dashboard. If disabled, they will be redirected to the URL below.')
                ->live(),
            Forms\Components\TextInput::make('redirect_url_when_auto_login_disabled')
                ->label('Redirect URL when auto-login is disabled')
                ->default('https://www.vantage-traders.net/')
                ->url()
                ->required()
                ->helperText('External URL to send users to after successful signup when auto-login is OFF.'),
        ]);
    }
}
