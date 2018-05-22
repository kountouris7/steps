<?php



Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/groups', 'GroupController@index')->name('show.groups');
Route::post('/booking/{group}', 'GroupController@store')->name('book.group');
Route::delete('/booking/{group}/', 'GroupUserController@destroy')->name('book.destroy');
Route::get('/profiles/{user}', 'ProfilesController@show')->name('profiles');

Route::group(['middleware' => 'is_admin'], function () {
    Route::get('/admin', 'AdminController@admin')->name('admin');
    Route::get('/lesson/create', 'AdminController@lessoncreate')->name('create.lesson');
    Route::post('/lesson/save', 'AdminController@lessonstore')->name('save.lesson');
    Route::get('/show/lessons', 'AdminController@lessonshow')->name('show.lesson');
    Route::get('/lesson/{id}', 'AdminController@groupcreate')->name('create.group');
    Route::post('/group/{id}', 'AdminController@groupstore')->name('save.group');
    Route::delete('/group/{id}', 'AdminController@destroygroup')->name('group.destroy');

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


