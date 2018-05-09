<?php

namespace App\Providers;

use App\Group;
use App\Lesson;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

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
        //$groups =  Group::with('lesson')->get();
        //View::share ('groups', $groups);

        //$lessons =  Lesson::with('group')->get();
        //View::share ('lessons', $lessons);

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
