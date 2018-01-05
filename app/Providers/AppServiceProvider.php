<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\CacheMessages; 
use App\Repositories\MessagesInterface; 

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(
            MessagesInterface::class, 
            CacheMessages::class
        );
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
