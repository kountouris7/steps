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
use App\User;
use Tests\TestCase;

$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
        'type' => 'default'
    ];
});

$factory->state(App\User::class, 'admin', [
    'type' => User::ADMIN_TYPE
]);

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
        'day_time' => $startDate = Carbon::createFromTimestamp($faker->dateTimeBetween('-30 days', '+30 days')->getTimestamp()),
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
                },
        'groupDay_time' => $startDate = Carbon::createFromTimestamp($faker->dateTimeBetween('-30 days', '+30 days')
                                                                     ->getTimestamp())
    ];
});


