<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Service\Pushall;

class PushallServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Pushall::class, function(){
            return new Pushall(config('laiker.pushall.api.id'), config('laiker.pushall.api.key'));
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
