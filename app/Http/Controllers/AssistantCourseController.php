<?php

namespace App\Http\Controllers;

use Auth;
use App\ModelLog;
use App\ModelUser;
use App\ModelCourse;
use App\ModelAssignment;
use App\ModelAssistantCourse;
use App\ModelUserAssignment;
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
            'course_id' => 'required',
        ]);

        $data = new ModelAssistantCourse();
        $data->assistant_id = $request->assistant_id;
        $data->course_id = $request->course_id;
        $data->save();

        $dataLogs = new ModelLog();
        $dataLogs->created_by = Auth::user()->name;
        $dataLogs->user_level = Auth::user()->level;
        $dataLogs->user_ip = \Request::ip();
        $dataLogs->action = "Melakukan penugasan terhadap asisten dengan id " . $data->assistant_id . " dan mata kuliah dengan id " . $data->course_id . ".";
        $dataLogs->save();

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
        $assignments = ModelAssignment::select('assignments.*')
                                                    ->leftjoin('courses', 'assignments.course_id', '=', 'courses.id')
                                                    ->where('course_id', '=', $course->id)
                                                    ->get()
                                                    ->sortBy('start_time');
        $assistantAssignments = ModelUserAssignment::all();

        $dataLogs = new ModelLog();
        $dataLogs->created_by = Auth::user()->name;
        $dataLogs->user_level = Auth::user()->level;
        $dataLogs->user_ip = \Request::ip();
        $dataLogs->action = "Mengakses halaman show course milik asisten.";
        $dataLogs->save();

        return view('assistant_courses.show', compact('course', 'assignments', 'assistantAssignments'));
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

        $dataLogs = new ModelLog();
        $dataLogs->created_by = Auth::user()->name;
        $dataLogs->user_level = Auth::user()->level;
        $dataLogs->user_ip = \Request::ip();
        $dataLogs->action = "Melakukan penghapusan penugasan terhadap asisten dengan id " . $id . ".";
        $dataLogs->save();
           
        return redirect('/')->with('alert-success','Berhasil dihapus');
    }
}
