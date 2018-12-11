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
        $assignedAssistants = ModelCourse::select('assistant_courses.id', 'users.name as user_name', 'courses.code', 'courses.name as course_name')
                                    ->join('assistant_courses', 'courses.id', '=', 'assistant_courses.course_id')
                                    ->join('users', 'users.id', '=', 'assistant_courses.assistant_id')
                                    ->get()
                                    ->sortBy('user_name');
                                    
        $assignedLecturers = ModelCourse::select('lecturer_courses.id', 'users.name as user_name', 'courses.code', 'courses.name as course_name')
                                    ->join('lecturer_courses', 'courses.id', '=', 'lecturer_courses.course_id')
                                    ->join('users', 'users.id', '=', 'lecturer_courses.lecturer_id')
                                    ->get()
                                    ->sortBy('user_name');

        $assignedStudents = ModelCourse::select('student_courses.id', 'users.name as user_name', 'courses.code', 'courses.name as course_name')
                                    ->join('student_courses', 'courses.id', '=', 'student_courses.course_id')
                                    ->join('users', 'users.id', '=', 'student_courses.student_id')
                                    ->get()
                                    ->sortBy('user_name');

        $dataLogs = new ModelLog();
        $dataLogs->created_by = Auth::user()->name;
        $dataLogs->user_level = Auth::user()->level;
        $dataLogs->user_ip = \Request::ip();
        $dataLogs->action = "Mengakses halaman index penugasan pengguna kepada mata kuliah.";
        $dataLogs->save();

        return view('assigns.index',  ['assignedAssistants' => $assignedAssistants, 'assignedLecturers' => $assignedLecturers, 'assignedStudents' => $assignedStudents, ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $lecturers = ModelUser::all()
                                    ->where('level', '=', 'Lecturer')
                                    ->where('deleted_at', '=', null)
                                    ->sortBy('name');
        $assistants = ModelUser::all()
                                    ->where('level', '=', 'Assistant')
                                    ->where('deleted_at', '=', null)
                                    ->sortBy('name');
        $students = ModelUser::all()
                                ->where('level', '=', 'Student')
                                ->where('deleted_at', '=', null)
                                ->sortBy('name');
        $courses = ModelCourse::all()
                                ->where('deleted_at', '=', null)
                                ->sortBy('name');

        $dataLogs = new ModelLog();
        $dataLogs->created_by = Auth::user()->name;
        $dataLogs->user_level = Auth::user()->level;
        $dataLogs->user_ip = \Request::ip();
        $dataLogs->action = "Mengakses halaman create penugasan pengguna kepada mata kuliah.";
        $dataLogs->save();

        return view('assigns.create', ['lecturers' => $lecturers, 'assistants' => $assistants, 'students' => $students, 'courses' => $courses]);
    }
}