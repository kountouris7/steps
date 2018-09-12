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
        $groups = Group::with('level', 'lesson', 'bookings', 'clients')
                       ->where('day_time', '>=', today()->nowWithSameTz()->toDateTimeString())
                       ->orderBy('day_time')
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
