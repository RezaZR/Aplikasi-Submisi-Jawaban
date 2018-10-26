<?php

namespace App\Http\Controllers;

use App\ModelCourse;
use Illuminate\Http\Request;

class CourseController extends Controller
{

    public function new() {
        return view('create');
    }

    public function create(Request $request) {
        $this->validate($request, [
            'code' => 'required|unique:course|max:6',
            'name' => 'required|max:255'
        ]);
        $data = new ModelCourse();
        $data->code = $request->code;
        $data->name = $request->name;
        $data->lecturer_id = 1;
        $data->save();
        return redirect('/')->with('alert-success','Berhasil membuat mata kuliah baru');
    }
}
