<?php

namespace App\Http\Controllers;

use App\ModelCourse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CourseController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        if (!Session::get('login')) {
            return redirect('login')->with('alert', 'Harus login terlebih dahulu');
        } else {
            return view('courses.create');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!Session::get('login')) {
            return redirect('login')->with('alert', 'Harus login terlebih dahulu');
        } else {
            $course = ModelCourse::find($id);

            return view('courses.show', compact('course'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!Session::get('login')) {
            return redirect('login')->with('alert', 'Harus login terlebih dahulu');
        } else {
            $course = ModelCourse::find($id);

            return view('courses.edit', compact('course'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'code' => 'required|max:6',
            'name' => 'required|max:50',
        ]);
        $data = ModelCourse::find($id);
        $data->code = $request->code;
        $data->name = $request->name;
        $data->save();
        return redirect('/')->with('alert-success','Berhasil mengubah detail mata kuliah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
            $course = ModelCourse::find($id);
            $course->delete();
           
            return redirect('/')->with('alert-success','Berhasil dihapus');
    }
}
