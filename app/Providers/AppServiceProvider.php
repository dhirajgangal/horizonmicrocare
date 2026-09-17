<?php

namespace App\Providers;

use App\Models\User;
use App\Services\SiteSettings;
use App\View\Composers\SettingsComposer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(SiteSettings::class);
    }

    public function boot(): void
    {
        Model::preventLazyLoading(! $this->app->isProduction());
        Paginator::useTailwind();

        Gate::define('access-admin', function (User $user): bool {
            return $user->hasRole('Super Admin');
        });

        View::composer([
            'layouts.*',
            'layouts.partials.*',
            'pages.*',
            'pages.legal.*',
            'livewire.public.*',
            'livewire.admin.*',
        ], SettingsComposer::class);
    }
}
