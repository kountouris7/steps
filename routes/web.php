<?php

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/show', 'GroupController@show')->name('show');
Route::post('/booking/{group}', 'GroupController@store')->name('store');
Route::delete('/booking/{group}', 'GroupUserController@destroy')->name('groupuser.destroy');
Route::get('/profiles/{user}', 'ProfilesController@show')->name('profiles');
Route::get('/admin', 'AdminController@admin')->middleware('is_admin')->name('admin');


