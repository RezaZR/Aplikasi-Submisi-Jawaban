<?php

namespace App\Http\Controllers;

use App\ModelUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function index() {
        if (!Session::get('login')) {
            return redirect('login')->with('alert', 'Harus login terlebih dahulu!');
        } else {
            return view('index');
        }
    }

    public function login() {
        return view('login');
    }

    public function loginPost(Request $request) {
        $email = $request->email;
        $password = $request->password;

        $data = ModelUser::where('email', $email)->first();
        if(count($data) > 0) {
            if(Hash::check($password, $data->password)) {
                Session::put('name', $data->name);
                Session::put('email', $data->email);
                Session::put('login', TRUE);
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
        return redirect('login')->with('alert-success', 'Berhasil keluar!');
    }

    public function register() {
        return view('register');
    }

    public function registerPost(Request $request) {
        $this->validate($request, [
            'name' => 'required|min:4',
            'email' => 'required|min:4|email|unique:user',
            'password' => 'required',
            'conf_password' => 'required|same:password',
        ]);
        $data =  new ModelUser();
        $data->name = $request->name;
        $data->email = $request->email;
        $data->password = bcrypt($request->password);
        $data->save();
        return redirect('login')->with('alert-success','Kamu Berhasil Register');
    }
}
