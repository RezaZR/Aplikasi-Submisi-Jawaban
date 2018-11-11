<?php

namespace App\Http\Controllers;

use Auth;
use App\ModelUser;
use App\ModelCourse;
use App\ModelAssignment;
use App\ModelLecturerCourse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LecturerCourseController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
        $loggedInUser = Auth::user();
        $lecturerCourses = ModelLecturerCourse::all()->where('lecturer_name', '=', $loggedInUser->id);
        $lecturerCourseList = ModelCourse::all()->where('id', '=', $lecturerCourses[0]->course_id);

        return view('lecturer_courses.index', compact('courses'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $this->validate($request, [
            'lecturer_id' => 'required',
            'course_id' => 'required',
        ]);
        $data = new ModelLecturerCourse();
        $data->lecturer_id = $request->lecturer_id;
        $data->course_id = $request->course_id;
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
        $course = ModelCourse::find($id);
        $lecturerAssignments = ModelAssignment::select('courses.id as course_id', 'courses.code as course_code','courses.name as course_name', 'assignments.*')
                                                    ->leftjoin('courses', 'assignments.course_id', '=', 'courses.id')
                                                    ->get()->sortBy('');

        return view('lecturer_courses.show', compact('lecturerAssignments', 'course'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $lecturerCourse = ModelLecturerCourse::find($id);

        return view('lecturer_courses.edit', compact('lecturerCourse'));
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
            'lecturer_id' => 'required',
            'course_id' => 'required',
        ]);
        $data = ModelLecturerCourse::find($id);
        $data->lecturer_id = $request->lecturer_id;
        $data->course_id = $request->course_id;
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
