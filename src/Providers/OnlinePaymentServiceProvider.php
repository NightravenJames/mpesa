<?php

namespace MPESA\Providers;

use MPESA\Services\OnlinePaymentService;
use Illuminate\Support\ServiceProvider;

class OnlinePaymentServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(OnlinePaymentService::class,function($app){
            $payment = new OnlinePaymentService;
            $payment->partyB = config('mpesa.paybill');
            $payment->passKey = config('mpesa.stk_passkey');
            $payment->callBackURL = config('mpesa.callback_url');
            $payment->timestamp =  now()->format('YmdHis');
            return $payment;
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