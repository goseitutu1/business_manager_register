<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('create-employee', function ($user) {
            return $user->type === "manager";
        });

        Gate::define('update-employee', function ($user) {
            return $user->type === "manager";
        });

        Gate::define('delete-employee', function ($user) {
            return $user->type === "manager";
        });
    }
}
