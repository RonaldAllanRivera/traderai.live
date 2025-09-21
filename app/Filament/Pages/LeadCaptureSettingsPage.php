<?php

namespace App\Filament\Pages;

use App\Settings\LeadCaptureSettings;
use Filament\Forms;
use Filament\Forms\Get;
use Filament\Pages\SettingsPage;
use Filament\Schemas\Schema;

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

            Forms\Components\Toggle::make('country_auto_adjust_enabled')
                ->label('Enable worldwide auto country code & flag')
                ->default(true)
                ->helperText('When enabled, the homepage will auto-adjust the country flag and dialing code based on geo/middleware. When disabled, the Priority Country below is enforced for all visitors.')
                ->live(),

            Forms\Components\Select::make('priority_country')
                ->label('Priority Country (when auto-adjust is disabled)')
                ->options([
                    'GB' => 'United Kingdom',
                    'US' => 'United States',
                    'IL' => 'Israel',
                    'AE' => 'United Arab Emirates',
                ])
                ->default('GB')
                ->native(false)
                ->disabled(fn ($get) => (bool) $get('country_auto_adjust_enabled'))
                ->helperText('When auto-adjust is OFF, force this country\'s flag/dial code on the form, and validate numbers for this region.'),
        ]);
    }
}
