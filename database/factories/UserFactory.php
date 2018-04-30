<?php

//use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/
/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Carbon\Carbon;

$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Lesson::class, function ($faker) {
    return [
        'name'=>$faker->sentence
    ];
});

$factory->define(App\Group::class, function ($faker) {
    return [
        'lesson_id' => function () {
            return factory('App\Lesson')->create()->id;
        },
        'date_time_stamps' => Carbon::now()->format('Y-m-d H:i:s'),
        'max_capacity'=>$faker->randomDigit
    ];
});
$factory->define(App\GroupUser::class, function ($faker) {
    return [
        'user_id' => function () {
            return factory('App\User')->create()->id;
        },
        'group_id' => function () {
            return factory('App\Group')->create()->id;
                }
        ];
});


