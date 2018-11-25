<?php

namespace App\Http\Controllers;

use Auth;
use App\ModelUser;
use App\ModelCourse;
use App\ModelAssignment;
use App\ModelStudentCourse;
use App\ModelUserAssignment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class StudentCourseController extends Controller
{

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $this->validate($request, [
            'student_id' => 'required',
            'course_id' => 'required',
        ]);
        $data = new ModelStudentCourse();
        $data->student_id = $request->student_id;
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
    public function show($course_id)
    {
        $course = ModelCourse::find($course_id);
        $assignments = ModelAssignment::select('assignments.*')
                                                    ->leftjoin('courses', 'assignments.course_id', '=', 'courses.id')
                                                    ->where('course_id', '=', $course->id)
                                                    ->get()
                                                    ->sortBy('start_time');
        return view('student_courses.show', compact('studentAssignments', 'course', 'assignments'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $studentCourses = ModelStudentCourse::find($id);

        return view('student_courses.edit', compact('studentCourses'));
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
            'student_id' => 'required',
            'course_id' => 'required',
        ]);
        $data = ModelStudentCourse::find($id);
        $data->student_id = $request->student_id;
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
            $studentCourses = ModelStudentCourse::find($id);
            $studentCourses->delete();
           
            return redirect('/')->with('alert-success','Berhasil dihapus');
    }
}
