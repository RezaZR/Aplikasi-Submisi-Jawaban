<?php

if (version_compare(PHP_VERSION, '7.2.0', '>=')) {
    // Ignores notices and reports all other kinds... and warnings
    error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
    // error_reporting(E_ALL ^ E_WARNING); // Maybe this is enough
}

// Route::get('/', function () {
//     return view('index');
// })->middleware('auth');
Route::get('/', 'UserController@index')->middleware('auth');

Route::get('/logout', 'UserController@logout');

Route::get('/login', ['as' => 'login', 'uses' => 'UserController@login']);
Route::post('/loginPost', 'UserController@loginPost');

Route::get('/register', 'UserController@register')->middleware('auth');
Route::post('/registerPost', 'UserController@registerPost')->middleware('auth');

Route::get('/course', 'CourseController@new')->middleware('auth');
Route::post('/createCourse', 'CourseController@create')->middleware('auth');