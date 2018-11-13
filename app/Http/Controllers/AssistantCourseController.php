<?php

namespace App\Http\Controllers;

use App\ModelUser;
use App\ModelCourse;
use App\ModelAssignment;
use App\ModelAssistantCourse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AssistantCourseController extends Controller
{

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $this->validate($request, [
            'assistant_id' => 'required',
            'course_id' => 'required|unique:assistant_courses',
        ]);
        $data = new ModelAssistantCourse();
        $data->assistant_id = $request->assistant_id;
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
        $assistantAssignments = ModelAssignment::select('assignments.*')
                                                    ->leftjoin('courses', 'assignments.course_id', '=', 'courses.id')
                                                    ->where('course_id', '=', $course->id)
                                                    ->get()
                                                    ->sortBy('start_time');

        return view('assistant_courses.show', compact('assistantAssignments', 'course'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $assistantCourses = ModelLecturerCourse::find($id);

        return view('assistant_courses.edit', compact('assistantCourses'));
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
            'assistant_id' => 'required',
            'course_id' => 'required',
        ]);
        $data = ModelAssitantCourse::find($id);
        $data->assistant_id = $request->assistant_id;
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
            $assistantCourses = ModelAssistantCourse::find($id);
            $assistantCourses->delete();
           
            return redirect('/')->with('alert-success','Berhasil dihapus');
    }
}
