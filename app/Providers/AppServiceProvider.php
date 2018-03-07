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
        //แผนก production
        \Gate::define('production',function($user){
            return $user->department_id === 1;
        });
        \Gate::define('production.supervisor',function($user){
            return ($user->job_position_id === 1);
        });
        \Gate::define('production.staff',function($user){
            return $user->job_position_id === 2;
        });
        // end แผนก
        //แผนก production
        \Gate::define('pqa',function($user){
            return $user->department_id === 2;
        });
        \Gate::define('pqa.supervisor',function($user){
            return ($user->job_position_id === 1) || ($user->role_id === 1);
        });
        \Gate::define('pqa.personnel',function($user){
            return $user->job_position_id === 2;
        });
        // end แผนก
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
