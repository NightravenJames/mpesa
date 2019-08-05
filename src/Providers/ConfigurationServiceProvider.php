<?php

namespace MPESA\Providers;

use Illuminate\Support\ServiceProvider;

class ConfigurationServiceProvider extends ServiceProvider {
        /**
         * Bootstrap any application services.
         *
         * @return void
         */
        public function boot()
        {
            $this->publishes([
                __DIR__.'/../../config/mpesa.php' => config_path('mpesa.php'),
            ],'mpesa-config');
        }
}