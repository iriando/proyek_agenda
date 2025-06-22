<?php

namespace App\Providers\Filament;

use Filament\Pages;
use Filament\Panel;
use Filament\Widgets;
use Filament\PanelProvider;
use Filament\Pages\Dashboard;
use Filament\Support\Colors\Color;
use App\Filament\Pages\ReportAgenda;
use App\Filament\Pages\SubmitSurvey;
use Filament\Navigation\NavigationItem;
use App\Filament\Pages\Auth\CustomLogin;
use App\Filament\Resources\UserResource;
use Filament\Navigation\NavigationGroup;
use App\Filament\Resources\AgendaResource;
use App\Filament\Resources\MateriResource;
use App\Filament\Resources\SurveyResource;
use Filament\Http\Middleware\Authenticate;
use Filament\Navigation\NavigationBuilder;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Cookie\Middleware\EncryptCookies;
use MarcoGermani87\FilamentCaptcha\FilamentCaptcha;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Saade\FilamentFullCalendar\FilamentFullCalendarPlugin;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Althinect\FilamentSpatieRolesPermissions\FilamentSpatieRolesPermissionsPlugin;
use App\Filament\Resources\AttributeDaftarHadirResource;
use App\Filament\Resources\LinkAddResource;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->brandName('E-Agenda')
            ->login(\App\Filament\Pages\Login::class)
            ->colors([
                'primary' => Color::Blue,
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                //
            ])

            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ])
            ->plugin(
                FilamentSpatieRolesPermissionsPlugin::make()
            )
            ->navigation(function (NavigationBuilder $builder): NavigationBuilder {
                return $builder->groups([
                    NavigationGroup::make()
                    ->items([
                        NavigationItem::make('Dashboard')
                        ->icon('heroicon-o-home')
                        ->url(fn (): string => Dashboard::getUrl()),
                    ]),
                    NavigationGroup::make('Agenda kegiatan')
                    ->items([
                        ...AgendaResource::getNavigationItems(),
                        // ...MateriResource::getNavigationItems(),
                        ...SurveyResource::getNavigationItems(),
                        ...LinkAddResource::getNavigationItems(),
                        ...ReportAgenda::getNavigationItems(),
                    ]),
                    NavigationGroup::make('Pengaturan')
                    ->items([
                        ...UserResource::getNavigationItems(),
                        NavigationItem::make('Roles')
                        ->icon('heroicon-o-user-group')
                        ->isActiveWhen(fn () => request()->routeIs([
                            'filament.admin.resources.roles.index',
                            'filament.admin.resources.roles.create',
                            'filament.admin.resources.roles.edit',
                            'filament.admin.resources.roles.view'
                        ]))
                        ->url(fn (): string => '/admin/roles')
                        ->visible(fn(): bool => auth()->user()->can('view roles')),

                        NavigationItem::make('Permissions')
                        ->icon('heroicon-o-lock-closed')
                        ->isActiveWhen(fn () => request()->routeIs([
                            'filament.admin.resources.permissions.index',
                            'filament.admin.resources.permissions.create',
                            'filament.admin.resources.permissions.edit',
                            'filament.admin.resources.permissions.view'
                        ]))
                        ->url(fn (): string => '/admin/permissions')
                        ->visible(fn(): bool => auth()->user()->can('view permission')),

                        ...AttributeDaftarHadirResource::getNavigationItems(),
                    ]),
                ]);
            })
            ->plugin(
                FilamentFullCalendarPlugin::make()
                    ->selectable()
                    ->editable()
            )
            ->databaseNotifications();
    }

}
