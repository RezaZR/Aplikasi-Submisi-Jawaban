<?php

namespace App\Http\Controllers;

use Auth;
use App\ModelUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SessionController extends Controller
{
    public function login() {
        return view('login');
    }

    public function store(Request $request) {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required'
        ]);

        $userdata = array(
            'email'     => $request->email,
            'password'  => $request->password
        );

        if (Auth::guard()->attempt($userdata)) {
            return redirect('/');
        } else {
            return redirect('/login')->with('error','Login Ulang, name atau Password anda salah');
        }
    }

    public function logout() {
        Auth::logout();
        return redirect('login')->with('alert-success', 'Berhasil keluar');
    }
}