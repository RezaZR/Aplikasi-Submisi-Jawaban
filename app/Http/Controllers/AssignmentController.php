<?php

namespace App\Http\Controllers;

use App\ModelAssignment;
use App\ModelCourse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AssignmentController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id) {
        $course = ModelCourse::find($id);

        return view('assignments.create', ['course' => $course]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $is_on_timeBool = $request->is_on_time === 'true' ? true:false;

        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'mode' => 'required',
            'is_on_time' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'course_id' => 'required',
        ]);

        $data = new ModelAssignment();
        $data->title = $request->title;
        $data->description = $request->description;
        $data->mode = $request->mode;
        $data->is_on_time = $is_on_timeBool;
        $data->start_time = $request->start_time;
        $data->end_time = $request->end_time;
        $data->course_id = $request->course_id;
        $data->save();

        return redirect('/')->with('alert-success','Berhasil membuat tempat pengumpulan baru');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($course_id, $assignment_id)
    {
        $course = ModelCourse::find($course_id);
        $assignment = ModelAssignment::find($assignment_id);
        $lecturerAssignments = ModelAssignment::select('courses.id as course_id', 'courses.code as course_code','courses.name as course_name', 'assignments.*')
                                                    ->leftjoin('courses', 'assignments.course_id', '=', 'courses.id')
                                                    ->get()
                                                    ->sortBy('start_time');
        
        return view('assignments.show', ['course' => $course, 'assignment' => $assignment]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($course_id, $assignment_id)
    {
        $course = ModelCourse::find($course_id);
        $assignment = ModelAssignment::find($assignment_id);
        // dd($assignment->id);
        $lecturerAssignments = ModelAssignment::select('courses.id as course_id', 'courses.code as course_code','courses.name as course_name', 'assignments.*')
                                                    ->leftjoin('courses', 'assignments.course_id', '=', 'courses.id')
                                                    ->get()
                                                    ->sortBy('start_time');

        return view('assignments.edit', ['course' => $course, 'assignment' => $assignment]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $course_id, $assignment_id)
    {
        $is_on_timeBool = $request->is_on_time === 'true' ? true:false;

        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'mode' => 'required',
            'is_on_time' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'course_id' => 'required',
        ]);

        $data = ModelAssignment::find($assignment_id);
        $data->title = $request->title;
        $data->description = $request->description;
        $data->mode = $request->mode;
        $data->is_on_time = $is_on_timeBool;
        $data->start_time = $request->start_time;
        $data->end_time = $request->end_time;
        $data->course_id = $request->course_id;
        $data->save();

        return redirect('/')->with('alert-success','Berhasil mengubah detail tempat pengumpulan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($course_id, $assignment_id)
    {
            $course = ModelAssignment::find($assignment_id);
            $course->delete();
           
            return redirect('/')->with('alert-success','Berhasil dihapus');
    }
}
