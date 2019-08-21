<?php

namespace MPESA\Providers;

use Carbon\Carbon;
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
            $base_uri = config('mpesa.developement_mode')?'https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/':'https://api.safaricom.co.ke/mpesa/stkpush/v1/';
            $payment = new OnlinePaymentService($base_uri);
            $payment->partyB = config('mpesa.paybill');
            $payment->passKey = config('mpesa.stk_passkey');
            $payment->callBackURL = config('mpesa.callback_url');
            $payment->timestamp =  Carbon::now()->format('YmdHis');
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
