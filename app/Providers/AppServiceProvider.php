<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\ServiceProvider;
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
        Gate::define('admin', function(User $user) {
            return $user->role === 'admin';
        });

        Gate::define('staff', function(User $user) {
            return $user->role === 'staff';
        });

        Gate::define('member', function(User $user) {
            return $user->role === 'member';
        });

        Gate::define('both', function (User $user) {
            return in_array($user->role, ['staff', 'admin']);
        });
    }
}
