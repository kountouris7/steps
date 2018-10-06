<?php

Auth::routes();
Route::get('/', 'HomeController@cover')->name('cover');
Route::get('/register', 'RegisterController@index')->name('register.form');
Route::post('/register', 'RegisterController@create')->name('register.user');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/groups', 'GroupController@index')->name('show.groups');
Route::post('/booking/{group}', 'GroupController@store')->name('book.group');
Route::delete('/booking/{group}', 'GroupUserController@destroy')->name('book.destroy');
Route::get('/profiles/{user}', 'ProfilesController@show')->name('profiles');
Route::get('profiles/{user}/past.bookings', 'ProfilesController@showPastBookings')->name('past.bookings');
// {token} is a required parameter that will be exposed to us in the controller method
Route::get('accept/{token}', 'InviteController@accept')->name('accept');
Route::get('/groups/{day}', 'GroupController@daysFilter')->name('groups.by.day');



Route::get('/testing', 'GroupController@reminders')->name('testing');
//Route::post('/testing/{group}/{user}', 'GroupController@store')->name('testing.vue');


Route::group(['middleware' => 'is_admin'], function () {
    Route::get('/admin', 'AdminController@admin')->name('admin');
    Route::get('/lesson/create', 'AdminController@lessoncreate')->name('create.lesson');
    Route::post('/lesson/save', 'AdminController@lessonstore')->name('save.lesson');
    Route::get('/show/lessons', 'AdminController@lessonshow')->name('show.lesson');
    Route::get('/lesson/{id}', 'AdminController@groupcreate')->name('create.group');
    Route::post('/group/{id}', 'AdminController@groupstore')->name('save.group');
    Route::get('/group/admin/groups', 'AdminController@showtoedit')->name('administrator.showgroups');
    Route::post('/group/edit/{id}', 'AdminController@editgroup')->name('group.edit');

    Route::post('/group/update/{id}', 'AdminController@updategroup')->name('group.update');

    Route::delete('/group/delete/{id}', 'AdminController@destroygroup')->name('group.destroy');
    Route::post('/create.level', 'AdminController@levelcreate')->name('create.level');
    Route::get('/see.attendances', 'AdminController@seeAttendances')->name('see.attendances');
    Route::get('/see.attendances/{day}', 'AdminController@attendanceByDay')->name('attendance.by.day');
    Route::get('/excel', 'SubscriberController@index')->name('upload.excel');
    Route::post('/import', 'SubscriberController@import')->name('import.excel');
    Route::get('/show/all.subscribers', 'SubscriberController@showAllSubscribers')->name('showAllSubscribers');
    Route::get('/show/subscribers', 'SubscriberController@showSubscribersCurrentMonth')->name('showSubscribersCurrentMonth');
    Route::get('/subscriber-profile{id}', 'SubscriberController@subscriberProfile')->name('subscriber.profile');
    Route::post('invite/', 'InviteController@process')->name('process');
    Route::post('send.multiple', 'InviteController@sendMultiple')->name('send.multiple');
    Route::get('create.email', 'EmailController@createEmail')->name('create.email');
    Route::post('send.email', 'EmailController@sendEmail')->name('send.email');
    Route::get('/see.subscribers/{month}', 'SubscriberController@showSubscribersByMonth')->name('subscriber.byMonth');

});




