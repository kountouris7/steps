<?php

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/show', 'GroupController@show')->name('show');
Route::post('/booking/{group}', 'GroupUserController@store')->name('store');
Route::get('/profiles/{user}', 'ProfilesController@show')->name('profile');


