<?php

namespace App\Http\Controllers;

use App\ModelUser;
use App\ModelCourse;
use App\ModelLecturerCourse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LecturerCourseController extends Controller
{

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $this->validate($request, [
            'lecturer_name' => 'required|unique:lecturer_courses',
            'course_name' => 'required|unique:lecturer_courses',
        ]);
        $data = new ModelLecturerCourse();
        $data->lecturer_name = $request->lecturer_name;
        $data->course_name = $request->course_name;
        $data->save();
        return redirect('/')->with('alert-success','Berhasil menugaskan pengguna ke dalam mata kuliah');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $lecturerCourses = ModelLecturerCourse::find($id);

        return view('lecturer_courses.show', compact('lecturerCourses'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $lecturerCourses = ModelLecturerCourse::find($id);

        return view('lecturer_courses.edit', compact('course'));
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
            'lecturer_name' => 'required',
            'course_name' => 'required',
        ]);
        $data = ModelLecturerCourse::find($id);
        $data->lecturer_name = $request->lecturer_name;
        $data->course_name = $request->course_name;
        $data->save();
        return redirect('/')->with('alert-success','Berhasil mengubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
            $lecturerCourses = ModelLecturerCourse::find($id);
            $lecturerCourses->delete();
           
            return redirect('/')->with('alert-success','Berhasil dihapus');
    }
}
