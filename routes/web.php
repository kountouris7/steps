<?php




Auth::routes();
Route::get('/', 'HomeController@cover')->name('cover');
Route::get('/register', 'RegisterController@index')->name('register.form');
Route::post('/register', 'RegisterController@create')->name('register.user');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/groups', 'GroupController@index')->name('show.groups');

Route::post('/booking/{group}', 'GroupController@store')->name('book.group');
Route::delete('/booking/{group}/', 'GroupUserController@destroy')->name('book.destroy');
Route::get('/profiles/{user}', 'ProfilesController@show')->name('profiles');
Route::get('profiles/{user}/past.bookings', 'ProfilesController@showPastBookings')->name('past.bookings');
// {token} is a required parameter that will be exposed to us in the controller method
Route::get('accept/{token}', 'InviteController@accept')->name('accept');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/groups/{day}/monday', 'GroupController@daysFilter')->name('monday.groups');
    Route::get('/groups/{day}/tuesday', 'GroupController@daysFilter')->name('tuesday.groups');
    Route::get('/groups/{day}/wednesday', 'GroupController@daysFilter')->name('wednesday.groups');
    Route::get('/groups/{day}/thursday', 'GroupController@daysFilter')->name('thursday.groups');
    Route::get('/groups/{day}/friday', 'GroupController@daysFilter')->name('friday.groups');
});


Route::group(['middleware' => 'is_admin'], function () {
    Route::get('/admin', 'AdminController@admin')->name('admin');
    Route::get('/lesson/create', 'AdminController@lessoncreate')->name('create.lesson');
    Route::post('/lesson/save', 'AdminController@lessonstore')->name('save.lesson');
    Route::get('/show/lessons', 'AdminController@lessonshow')->name('show.lesson');
    Route::get('/lesson/{id}', 'AdminController@groupcreate')->name('create.group');
    Route::post('/group/{id}', 'AdminController@groupstore')->name('save.group');
    Route::delete('/group/{id}', 'AdminController@destroygroup')->name('group.destroy');
    Route::post('/create.level', 'AdminController@levelcreate')->name('create.level');
    Route::get('/see.attendances', 'AdminController@seeAttendances')->name('see.attendances');
    Route::get('/excel', 'SubscriberController@index')->name('upload.excel');
    Route::post('/import', 'SubscriberController@import')->name('import.excel');
    Route::get('/show/subscribers', 'SubscriberController@showSubscribers')->name('show.subscribers');
    Route::get('/subscriber-profile{id}', 'SubscriberController@subscriberProfile')->name('subscriber.profile');
    Route::post('invite', 'InviteController@process')->name('process');
    Route::post('send.multiple', 'InviteController@sendMultiple')->name('send.multiple');
    Route::get('create.email', 'EmailController@createEmail')->name('create.email');
    Route::post('send.email', 'EmailController@sendEmail')->name('send.email');

    Route::get('/see.attendances/{day}/monday', 'AdminController@attendanceByDay')->name('monday.attendances');
    Route::get('/see.attendances/{day}/tuesday', 'AdminController@attendanceByDay')->name('tuesday.attendances');
    Route::get('/see.attendances/{day}/wednesday', 'AdminController@attendanceByDay')->name('wednesday.attendances');
    Route::get('/see.attendances/{day}/thursday', 'AdminController@attendanceByDay')->name('thursday.attendances');
    Route::get('/see.attendances/{day}/friday', 'AdminController@attendanceByDay')->name('friday.attendances');

});




