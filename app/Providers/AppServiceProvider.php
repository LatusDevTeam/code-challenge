<?php

namespace App\Providers;

use App\Interfaces\SpotifyApiInterface;
use App\Service\SpotifyApiService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public $bindings = [
        SpotifyApiInterface::class => SpotifyApiService::class,
    ];
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
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
