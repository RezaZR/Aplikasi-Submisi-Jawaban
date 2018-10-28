<?php

namespace App\Http\Controllers;

use App\ModelUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        if (!Session::get('login')) {
            return redirect('login')->with('alert', 'Harus login terlebih dahulu');
        } else {
            $i = 0;
            $j = 0;
            $userAssistant = DB::table('users')->where('level', '=', 'Assistant')->orWhereNotNull('deleted_at')->get();
            $userLecturer = DB::table('users')->where('level', '=', 'Lecturer')->orWhereNotNull('deleted_at')->get();
            $userStudent = DB::table('users')->where('level', '=', 'Student')->orWhereNotNull('deleted_at')->get();
            $userAdmin = DB::table('users')->where('level', '=', 'Admin')->orWhereNotNull('deleted_at')->get();
            $courses = DB::table('courses')->whereNull('deleted_at')->get();
            return view('index', ['userAssistant' => $userAssistant, 'userLecturer' => $userLecturer, 'userStudent' => 
        $userStudent, 'userAdmin' => $userAdmin, 'courses' => $courses])->with('i', $i)->with('j', $j);
        }
    }
}