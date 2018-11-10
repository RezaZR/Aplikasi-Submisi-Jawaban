<?php

if (version_compare(PHP_VERSION, '7.2.0', '>=')) {
    error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
    // error_reporting(E_ALL ^ E_WARNING);
}

Route::group(['middleware' => ['auth']], function() {
    Route::get('/', 'UserController@index');

    Route::resource('users', 'RegisterController');
    
    Route::resource('courses', 'CourseController');

    Route::resource('assigns', 'AssignController');
    Route::resource('lecturer_courses', 'LecturerCourseController', ['except' => ['index']]);
    Route::resource('assistant_courses', 'AssistantCourseController');
    Route::resource('student_courses', 'StudentCourseController');

    Route::get('lecturer_courses/{id}/assignments/create', 'AssignmentController@create');
    Route::resource('/assignments', 'AssignmentController');
});

Route::get('/login', ['as' => 'login', 'uses' => 'SessionController@login']);
Route::post('/session', 'SessionController@store');
Route::get('/logout', 'SessionController@logout');