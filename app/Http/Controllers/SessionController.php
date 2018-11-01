<?php

namespace App\Http\Controllers;

use App\ModelUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class SessionController extends Controller
{
    public function session() {
        return view('login');
    }

    public function store(Request $request) {
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
}
