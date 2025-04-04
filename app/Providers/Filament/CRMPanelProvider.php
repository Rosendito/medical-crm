<?php

namespace App\Providers\Filament;

use App\Enums\Filament\PanelIdentifier;
use App\Filament\Auth\Login;
use App\Filament\Auth\RequestPasswordReset;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class CRMPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id(PanelIdentifier::CRM->value)
            ->path(PanelIdentifier::CRM->path())
            ->tap(fn ($panel) => $this->configureAuthentication($panel))
            ->tap(fn ($panel) => $this->configureColors($panel))
            ->tap(fn ($panel) => $this->registerPages($panel))
            ->tap(fn ($panel) => $this->registerWidgets($panel))
            ->tap(fn ($panel) => $this->registerAutoDiscovery($panel))
            ->tap(fn ($panel) => $this->registerMiddleware($panel));
    }

    protected function configureAuthentication(Panel $panel): void
    {
        $panel
            ->login(Login::class)
            ->passwordReset(RequestPasswordReset::class)
            ->authMiddleware([
                Authenticate::class,
            ]);
    }

    protected function configureColors(Panel $panel): void
    {
        $panel->colors([
            'primary' => Color::Amber,
        ]);
    }

    protected function registerPages(Panel $panel): void
    {
        $panel->pages([
            Pages\Dashboard::class,
        ]);
    }

    protected function registerWidgets(Panel $panel): void
    {
        $panel->widgets([
            Widgets\AccountWidget::class,
            Widgets\FilamentInfoWidget::class,
        ]);
    }

    protected function registerAutoDiscovery(Panel $panel): void
    {
        $panel
            ->discoverResources(in: app_path('Filament/CRM/Resources'), for: 'App\\Filament\\CRM\\Resources')
            ->discoverPages(in: app_path('Filament/CRM/Pages'), for: 'App\\Filament\\CRM\\Pages')
            ->discoverWidgets(in: app_path('Filament/CRM/Widgets'), for: 'App\\Filament\\CRM\\Widgets');
    }

    protected function registerMiddleware(Panel $panel): void
    {
        $panel->middleware([
            EncryptCookies::class,
            AddQueuedCookiesToResponse::class,
            StartSession::class,
            AuthenticateSession::class,
            ShareErrorsFromSession::class,
            VerifyCsrfToken::class,
            SubstituteBindings::class,
            DisableBladeIconComponents::class,
            DispatchServingFilamentEvent::class,
        ]);
    }
}
