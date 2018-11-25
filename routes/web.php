<?php

if (version_compare(PHP_VERSION, '7.2.0', '>=')) {
    error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
    // error_reporting(E_ALL ^ E_WARNING);
}

Route::group(['middleware' => ['auth']], function() {
    Route::get('/', 'UserController@index');


    Route::resource('users', 'RegisterController');
    

    Route::resource('courses', 'CourseController');
    

    Route::resource('assignments', 'AssignmentController', ['only' => ['index']]);


    Route::resource('assigns', 'AssignController');
    Route::resource('lecturer_courses', 'LecturerCourseController', ['except' => ['index']]);
    Route::resource('assistant_courses', 'AssistantCourseController');
    Route::resource('student_courses', 'StudentCourseController');


    Route::get('lecturer_courses/{id}/assignments/create', [
        'as' => 'assignments.create', 
        'uses' => 'AssignmentController@create'
    ]);
    Route::post('lecturer_courses/{id}/assignments', [
        'as' => 'assignments.store', 
        'uses' => 'AssignmentController@store'
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


    Route::get('user_courses/{course_id}/assignments/{assignment_id}', [
        'as' => 'assignments.show', 
        'uses' => 'AssignmentController@show'
    ]);

    
    Route::get('user_courses/{course_id}/assignments/{assignment_id}/student_assignments', [
        'as' => 'student_assignments.index', 
        'uses' => 'StudentAssignmentController@index'
    ]);
    Route::get('user_courses/{course_id}/assignments/{assignment_id}/student_assignments/create', [
        'as' => 'student_assignments.create', 
        'uses' => 'StudentAssignmentController@create'
    ]);
    Route::post('user_courses/{course_id}/assignments/{assignment_id}/student_assignments', [
        'as' => 'student_assignments.store', 
        'uses' => 'StudentAssignmentController@store'
    ]);
    Route::get('user_courses/{course_id}/assignments/{assignment_id}/student_assignments/{user_assignment_id}', [
        'as' => 'student_assignments.show', 
        'uses' => 'StudentAssignmentController@show'
    ]);
    Route::get('user_courses/{course_id}/assignments/{assignment_id}/student_assignments/{user_assignment_id}/edit', [
        'as' => 'student_assignments.edit', 
        'uses' => 'StudentAssignmentController@edit'
    ]);
    Route::patch('user_courses/{course_id}/assignments/{assignment_id}/student_assignments/{user_assignment_id}', [
        'as' => 'student_assignments.update', 
        'uses' => 'StudentAssignmentController@update'
    ]);


    Route::get('user_courses/{course_id}/assignments/{assignment_id}/student_assignments/{user_assignment_id}/grade', [
        'as' => 'grader_assignments.index', 
        'uses' => 'GraderAssignmentController@index'
    ]);
    Route::get('user_courses/{course_id}/assignments/{assignment_id}/student_assignments/{user_assignment_id}/grade/create', [
        'as' => 'grader_assignments.create', 
        'uses' => 'GraderAssignmentController@create'
    ]);
    Route::post('user_courses/{course_id}/assignments/{assignment_id}/student_assignments/{user_assignment_id}/grade', [
        'as' => 'grader_assignments.store', 
        'uses' => 'GraderAssignmentController@store'
    ]);
    Route::get('user_courses/{course_id}/assignments/{assignment_id}/student_assignments/{user_assignment_id}/grade/edit', [
        'as' => 'grader_assignments.edit', 
        'uses' => 'GraderAssignmentController@edit'
    ]);
    Route::patch('user_courses/{course_id}/assignments/{assignment_id}/student_assignments/{user_assignment_id}/grade', [
        'as' => 'grader_assignments.update', 
        'uses' => 'GraderAssignmentController@update'
    ]);

    
    Route::resource('logs', 'LogsController');
});

Route::get('/login', 
    ['as' => 'login', 
    'uses' => 'SessionController@login'
]);
Route::post('/session', 
    ['as' => 'session', 
    'uses' => 'SessionController@store'
]);
Route::get('/logout', 
    ['as' => 'logout', 
    'uses' => 'SessionController@logout'
]);