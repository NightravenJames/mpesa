<?php

namespace MPESA\Providers;

use MPESA\Services\AuthService;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('mpesa-auth',function($app){
            $base_uri = config('mpesa.developement_mode')?'https://sandbox.safaricom.co.ke/oauth/v1/':'https://api.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';
            $auth = new AuthService(config('mpesa.username'),config('mpesa.password'),$base_uri);
            return $auth;
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}