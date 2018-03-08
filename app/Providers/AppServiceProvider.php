<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        \Gate::define('admin',function($user){
            return $user->role_id === 1;
        });
        \Gate::define('user',function($user){
            return $user->role_id === 2;
        });
        \Gate::define('editor',function($user){
            return $user->role_id === 3;
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
