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

    Route::get('lecturer_courses/{id}/assignments/create', [
        'as' => 'assignments.create', 
        'uses' => 'AssignmentController@create'
    ]);
    Route::post('assignments', [
        'as' => 'assignments.store', 
        'uses' => 'AssignmentController@store'
    ]);
    Route::get('lecturer_courses/{course_id}/assignments/{assignment_id}', [
        'as' => 'assignments.show', 
        'uses' => 'AssignmentController@show'
    ]);
    Route::get('lecturer_courses/{course_id}/assignments/{assignment_id}/edit', [
        'as' => 'assignments.edit', 
        'uses' => 'AssignmentController@edit'
    ]);
    Route::put('lecturer_courses/{course_id}/assignments/{assignment_id}', [
        'as' => 'assignments.update', 
        'uses' => 'AssignmentController@update'
    ]);
    Route::delete('lecturer_courses/{course_id}/assignments/{assignment_id}', [
        'as' => 'assignments.destroy', 
        'uses' => 'AssignmentController@destroy'
    ]);
});

Route::get('/login', ['as' => 'login', 'uses' => 'SessionController@login']);
Route::post('/session', 'SessionController@store');
Route::get('/logout', 'SessionController@logout');