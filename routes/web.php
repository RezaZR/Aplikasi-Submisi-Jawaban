<?php

if (version_compare(PHP_VERSION, '7.2.0', '>=')) {
    // Ignores notices and reports all other kinds... and warnings
    error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
    // error_reporting(E_ALL ^ E_WARNING); // Maybe this is enough
}

Route::get('/', function () {
    return view('index');
});
Route::get('/', 'UserController@index');

Route::get('/login', 'UserController@login');
Route::post('/loginPost', 'UserController@loginPost');

Route::get('/register', 'UserController@register');
Route::post('/registerPost', 'UserController@registerPost');

Route::get('/logout', 'UserController@logout');

Route::get('/course', 'CourseController@create');
Route::post('/coursePost', 'CourseController@createPost');