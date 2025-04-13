<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\URL;
use Laravel\Socialite\Facades\Socialite;
use GuzzleHttp\Client;

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
        //
        if (env('APP_URL') && str_contains(env('APP_URL'), 'ngrok')) {
            URL::forceScheme('https');
        }
        Socialite::driver('google')->setHttpClient(new Client([
            'verify' => 'c:/wamp64/cacert.pem',
            'timeout' => 15
        ]));
        Schema::defaultStringLength(191);
    }
}
