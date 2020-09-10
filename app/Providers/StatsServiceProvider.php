<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;


class StatsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
      $this->app->singleton(StatsCounter::class, function ()  {
        return new StatsCounter();
      });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //app(\App\Services\StatsCounter::class)->NationsReset();
    }
}
