<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Enums\Role;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //Image::class => PolicyForImage::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {

        $this->registerPolicies();
        // Authorization Gates
        // register a policy
        // first way to register a policy
        //Gate::define('update-image',[PolicyForImage::class, 'update']);

        //Gate::define('delete-image',[PolicyForImage::class,'delete']);

        // for admin access (grant all permissions)
        Gate::before(function($user, $ability){
            if($user->role === Role::Admin){
                return true;
            }
        });
    }
}
