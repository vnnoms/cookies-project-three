<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\User;
use App\Observers\UserObserver;
use Illuminate\Support\Facades\Gate;

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
        Gate::define('manage-roles', function (User $user): bool {
            return $user->role === 'admin';
        });

        Gate::define('manage-products', function (User $user): bool {
            return $user->role === 'admin';
        });

        Gate::define('adjust-stock', function (User $user): bool {
            return in_array($user->role, ['staff', 'admin'], true);
        });

        Gate::define('use-cart', function (User $user): bool {
            return $user->role === 'customer';
        });

        User::observe(UserObserver::class);
    }
}

