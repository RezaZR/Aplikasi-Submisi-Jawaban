<?php

if (version_compare(PHP_VERSION, '7.2.0', '>=')) {
    error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
    // error_reporting(E_ALL ^ E_WARNING);
}

Route::get('/', 'UserController@index');

Route::get('/login', ['as' => 'login', 'uses' => 'SessionController@session']);
Route::post('/session', 'SessionController@store');
Route::get('/logout', 'SessionController@logout');

Route::resource('registers', 'RegisterController');

Route::resource('courses', 'CourseController');