<?php

namespace App\Http\Controllers;

use Auth;
use App\ModelLog;
use App\ModelUser;
use App\ModelCourse;
use App\ModelAssistantCourse;
use App\ModelLecturerCourse;
use App\ModelStudentCourse;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Res ponse
     */
    public function index() {   
        $loggedInUser = Auth::user();
        
        $userAssistant = ModelUser::where('level', '=', 'Assistant')->take(5)->latest()->get();
        $userLecturer = ModelUser::where('level', '=', 'Lecturer')->take(5)->latest()->get();
        $userStudent = ModelUser::where('level', '=', 'Student')->take(5)->latest()->get();
        $userAdmin = ModelUser::where('level', '=', 'Admin')->take(5)->latest()->get();
        $courses = ModelCourse::take(5)->latest()->get();

        $lecturerCourses = ModelLecturerCourse::select('courses.id as course_id', 'courses.code as course_code','courses.name as course_name')
                                                    ->leftjoin('courses', 'lecturer_courses.course_id', '=', 'courses.id')
                                                    ->leftjoin('users', 'lecturer_courses.lecturer_id', '=', 'users.id')
                                                    ->where('lecturer_id', '=', $loggedInUser->id)
                                                    ->get()->sortBy('course_name');

        $assistantCourses = ModelAssistantCourse::select('courses.id as course_id', 'courses.code as course_code','courses.name as course_name')
                                                    ->leftjoin('courses', 'assistant_courses.course_id', '=', 'courses.id')
                                                    ->leftjoin('users', 'assistant_courses.assistant_id', '=', 'users.id')
                                                    ->where('assistant_id', '=', $loggedInUser->id)
                                                    ->get()->sortBy('course_name');

        $studentCourses = ModelStudentCourse::select('courses.id as course_id', 'courses.code as course_code','courses.name as course_name')
                                                    ->leftjoin('courses', 'student_courses.course_id', '=', 'courses.id')
                                                    ->leftjoin('users', 'student_courses.student_id', '=', 'users.id')
                                                    ->where('student_id', '=', $loggedInUser->id)
                                                    ->get()->sortBy('course_name');
        
        $dataLogs = new ModelLog();
        $dataLogs->created_by = Auth::user()->name;
        $dataLogs->user_level = Auth::user()->level;
        $dataLogs->user_ip = \Request::ip();
        $dataLogs->action = "Mengakses halaman index milik tata usaha.";
        $dataLogs->save();

        return view('index', ['userAssistant' => $userAssistant, 'userLecturer' => $userLecturer, 'userStudent' => $userStudent, 'userAdmin' => $userAdmin, 'courses' => $courses, 'lecturerCourses' => $lecturerCourses, 'assistantCourses' => $assistantCourses, 'studentCourses' => $studentCourses]);
    }
}