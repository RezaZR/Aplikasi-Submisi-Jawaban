<?php

namespace App\Http\Controllers;

use App\ModelCourse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CourseController extends Controller
{

    public function new() {
        if (!Session::get('login')) {
            return redirect('login')->with('alert', 'Harus login terlebih dahulu');
        } else {
            return view('create');
        }
    }

    public function create(Request $request) {
        $this->validate($request, [
            'code' => 'required|unique:courses|max:6',
            'name' => 'required|max:50',
        ]);
        $data = new ModelCourse();
        $data->code = $request->code;
        $data->name = $request->name;
        $data->save();
        return redirect('/')->with('alert-success','Berhasil membuat mata kuliah baru');
    }
}
