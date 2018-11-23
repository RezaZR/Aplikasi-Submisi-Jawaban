<?php

namespace App\Http\Controllers;

use Auth;
use App\ModelLog;
use App\ModelUser;
use App\ModelCourse;
use App\ModelLecturerCourse;
use App\ModelAssistantCourse;
use App\ModelStudentCourse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AssignController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
        $lecturerCourses = ModelLecturerCourse::all()->take(5)->sortBy('created_at');
        $assistantCourses = ModelAssistantCourse::all()->take(5)->sortBy('created_at');
        $studentCourses = ModelStudentCourse::all()->take(5)->sortBy('created_at');

        return view('assigns.index',  ['lecturerCourses' => $lecturerCourses, 'assistantCourses' => $assistantCourses, 'studentCourses' => $studentCourses]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $lecturers = ModelUser::all()->where('level', '=', 'Lecturer')->sortBy('name');
        $assistants = ModelUser::all()->where('level', '=', 'Assistant')->sortBy('name');
        $students = ModelUser::all()->where('level', '=', 'Student')->sortBy('name');
        $courses = ModelCourse::all()->sortBy('name');

        return view('assigns.create', ['lecturers' => $lecturers, 'assistants' => $assistants, 'students' => $students, 'courses' => $courses]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($course_id, $assignment_id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $course_id, $assignment_id)
    {

    }
}