<?php

namespace App\Http\Controllers;

use App\ModelUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index() {
        if (!Session::get('login')) {
            return redirect('login')->with('alert', 'Harus login terlebih dahulu');
        } else {
            $i = 0;
            $j = 0;
            $userAssistant = DB::table('users')->where('level', '=', 'Assistant')->get();
            $userLecturer = DB::table('users')->where('level', '=', 'Lecturer')->get();
            $userStudent = DB::table('users')->where('level', '=', 'Student')->get();
            $userAdmin = DB::table('users')->where('level', '=', 'Admin')->get();
            // $users = DB::table('users')->get();
            $courses = DB::table('courses')->get();
            return view('index', ['userAssistant' => $userAssistant, 'userLecturer' => $userLecturer, 'userStudent' => 
        $userStudent, 'userAdmin' => $userAdmin, 'courses' => $courses])->with('i', $i)->with('j', $j);
        }
    }

    public function login() {
        return view('login');
    }

    public function session(Request $request) {
        $email = $request->email;
        $password = $request->password;

        $data = ModelUser::where('email', $email)->first();
        if(count($data) > 0) {
            if(Hash::check($password, $data->password)) {
                Session::put('name', $data->name);
                Session::put('npm', $data->npm);
                Session::put('nik', $data->nik);
                Session::put('level', $data->level);
                Session::put('email', $data->email);
                Session::put('login', TRUE);
                Session::put('i', 0);
                return redirect('/');
            } else {
                return redirect('login')->with('alert', 'Password salah');
            }
        } else {
            return redirect('login')->with('alert', 'Email tidak terdaftar, coba lagi');
        }
    }

    public function logout() {
        Session::flush();
        return redirect('login')->with('alert-success', 'Berhasil keluar');
    }

    public function register() {
        if (!Session::get('login')) {
            return redirect('login')->with('alert', 'Harus login terlebih dahulu');
        } else {
            return view('register');
        }
    }

    public function createUser(Request $request) {
        $this->validate($request, [
            'name' => 'required|min:4',
            'email' => 'required|min:4|email',
            'password' => 'required',
            'conf_password' => 'required|same:password',
            'level' => 'required',
            'phone_number' => 'required',
            'address' => 'required',
            'birth_date' => 'required',
            'sex' => 'required',
        ]);
        $data = new ModelUser();
        $data->name = $request->name;
        $data->npm = $request->npm;
        $data->nik = $request->nik;
        $data->email = $request->email;
        $data->password = bcrypt($request->password);
        $data->level = $request->level;
        $data->phone_number = $request->phone_number;
        $data->address = $request->address;
        $data->sex = $request->sex;
        $data->birth_date = $request->birth_date;
        $data->save();
        return redirect('/')->with('alert-success','Berhasil registrasi pengguna baru');
    }
}