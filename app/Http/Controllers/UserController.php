<?php

namespace App\Http\Controllers;

use App\ModelUser;
use App\ModelCourse;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $i = 0;
        $j = 0;
        $k = 0;
        $l = 0;
        $m = 0;
        $userAssistant = ModelUser::all()->where('level', '=', 'Assistant')->take(5)->sortBy('created_at');
        $userLecturer = ModelUser::all()->where('level', '=', 'Lecturer')->take(5)->sortBy('created_at');
        $userStudent = ModelUser::all()->where('level', '=', 'Student')->take(5)->sortBy('created_at');
        $userAdmin = ModelUser::all()->where('level', '=', 'Admin')->take(5)->sortBy('created_at');
        $courses = ModelCourse::all()->take(5)->sortBy('created_at');
        return view('index', ['userAssistant' => $userAssistant, 'userLecturer' => $userLecturer, 'userStudent' => $userStudent, 'userAdmin' => $userAdmin, 'courses' => $courses, 'i' => $i, 'j' => $j, 'k' => $k, 'l' => $l, 'm' => $m]);
    }
}