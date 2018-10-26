<?php

if (version_compare(PHP_VERSION, '7.2.0', '>=')) {
    // Ignores notices and reports all other kinds... and warnings
    error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
    // error_reporting(E_ALL ^ E_WARNING); // Maybe this is enough
}

// Route::get('/', function () {
//     return view('index');
// });
Route::get('/', 'UserController@index');

Route::get('/logout', 'UserController@logout');

Route::get('/login', ['as' => 'login', 'uses' => 'UserController@login']);
Route::post('/session', 'UserController@session');

// Route::get('/register', 'UserController@register')->middleware('auth');
Route::get('/register', 'UserController@register');
// Route::post('/createUser', 'UserController@createUser')->middleware('auth');
Route::post('/createUser', 'UserController@createUser');

Route::get('/course', 'CourseController@new');
Route::post('/createCourse', 'CourseController@create');