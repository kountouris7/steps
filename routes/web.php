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
// {token} is a required parameter that will be exposed to us in the controller method
Route::get('accept/{token}', 'InviteController@accept')->name('accept');




Route::group(['middleware' => 'is_admin'], function () {
    Route::get('/admin', 'AdminController@admin')->name('admin');
    Route::get('/lesson/create', 'AdminController@lessoncreate')->name('create.lesson');
    Route::post('/lesson/save', 'AdminController@lessonstore')->name('save.lesson');
    Route::get('/show/lessons', 'AdminController@lessonshow')->name('show.lesson');
    Route::get('/lesson/{id}', 'AdminController@groupcreate')->name('create.group');
    Route::post('/group/{id}', 'AdminController@groupstore')->name('save.group');
    Route::delete('/group/{id}', 'AdminController@destroygroup')->name('group.destroy');
    Route::get('/excel', 'SubscriberController@index')->name('upload.excel');
    Route::post('/import', 'SubscriberController@import')->name('import.excel');
    Route::get('/show/subscribers', 'SubscriberController@showSubscribers')->name('show.subscribers');
    Route::get('/subscriber-profile{id}', 'SubscriberController@subscriberProfile')->name('subscriber.profile');
    //Route::get('invite', 'InviteController@invite')->name('invite');
    Route::post('invite', 'InviteController@process')->name('process');
    Route::post('send.multiple', 'InviteController@sendMultiple')->name('send.multiple');


});
//
//$groups=Group::with('clients')->has('clients')->get()->mapWithKeys(function ($group) {
//    return [
//        $group->id => $group->clients->count(),
//    ];
//});
//
//dd($groups->all());

//$g = GroupUser::selectRaw('sum(user_id) as userCount')->groupBy('group_id')->get();

//dd($g->toArray());


