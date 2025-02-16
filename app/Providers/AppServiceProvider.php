<?php

namespace App\Providers;

use App\Models\User;
use Livewire\Livewire;
use App\Observers\UserObserver;
use App\Filament\Pages\SubmitSurvey;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Filament\Notifications\Livewire\DatabaseNotifications;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Schema::defaultStringLength(191);
        User::observe(UserObserver::class);
        Livewire::component('filament.livewire.database-notifications', DatabaseNotifications::class);
        Livewire::component('filament.pages.submit-survey', SubmitSurvey::class);
    }
}
