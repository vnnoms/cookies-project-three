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

        Gate::define('manage-products', fn (User $user) =>
            $user->role === 'admin'
        );

        Gate::define('adjust-stock', fn (User $user) =>
            in_array($user->role, ['staff', 'admin'], true)
        );

        Gate::define('use-cart', fn (User $user) =>
            $user->role === 'customer'
        );

        User::observe(UserObserver::class);
    }
}

