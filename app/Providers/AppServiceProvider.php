<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        true;
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Paginator::useBootstrapFive(); // これオンにするとブートストラップ起動するからpaginationのカッコの中に'pagination::bootstrap-4'とかって書ける。ただ、これオフにして、breezeのやつ有効にした方がかっこいい
        \URL::forceScheme('https');
        $this->app['request']->server->set('HTTPS','on');
    }
}
