<?php

namespace App\Providers;

use App\Services\KavehnegarSMS;
use App\Services\SMS;
use Illuminate\Support\ServiceProvider;
use Kavenegar\KavenegarApi;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        app()->bind(SMS::class, function () {
            $sms = new KavenegarApi(config('services.kavenegar.key'));
            return new KavehnegarSMS($sms);
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
