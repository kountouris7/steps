<?php

namespace App\Providers;

use App\Group;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *

     *
     * @return void
     */
    public function boot()
    {
        $groups = Group::where('day_time', '>=', today()->nowWithSameTz()->toDateTimeString())
                       ->latest()
                       ->get();

        View::share('groups', $groups);

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->isLocal()) {
            $this->app->register(\Barryvdh\Debugbar\ServiceProvider::class);
        }
    }
}
