<?php

namespace App\Http\Controllers;

use Auth;
use App\ModelLog;
use App\ModelAssignment;
use App\ModelCourse;
use App\ModelUserAssignment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AssignmentController extends Controller

{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
        $courseAssignments = ModelCourse::select('courses.id as course_id', 'courses.code as course_code', 'courses.name as course_name', 'assignments.id as assignment_id', 'assignments.title', 'assignments.mode', 'assignments.start_time', 'assignments.end_time')
                                                    ->leftjoin('assignments', 'courses.id', '=', 'assignments.course_id')
                                                    ->whereColumn('courses.id', '=', 'assignments.course_id')
                                                    ->where('assignments.deleted_at', '=', null)
                                                    ->get();

        $gradedAssignments = ModelUserAssignment::select('user_assignments.*', 'student_courses.*')
                                    ->leftjoin('student_courses', 'user_assignments.student_id', '=', 'student_courses.student_id')
                                    ->where('user_assignments.status', '=', 'Submitted')
                                    ->get();

        $ungradedAssignments = ModelUserAssignment::select('user_assignments.*', 'student_courses.*')
                                    ->leftjoin('student_courses', 'user_assignments.student_id', '=', 'student_courses.student_id')
                                    ->where('user_assignments.status', '=', 'Graded')
                                    ->get();

        $dataLogs = new ModelLog();
        $dataLogs->created_by = Auth::user()->name;
        $dataLogs->user_level = Auth::user()->level;
        $dataLogs->user_ip = \Request::ip();
        $dataLogs->action = "Mengakses halaman index tugas milik tata usaha.";
        $dataLogs->save();

        return view('assignments.index', ['courseAssignments' => $courseAssignments]);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id) {
        $course = ModelCourse::find($id);

        $dataLogs = new ModelLog();
        $dataLogs->created_by = Auth::user()->name;
        $dataLogs->user_level = Auth::user()->level;
        $dataLogs->user_ip = \Request::ip();
        $dataLogs->action = "Mengakses halaman create pembuatan tugas baru.";
        $dataLogs->save();

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
        
        $dataLogs = new ModelLog();
        $dataLogs->created_by = Auth::user()->name;
        $dataLogs->user_level = Auth::user()->level;
        $dataLogs->user_ip = \Request::ip();
        $dataLogs->action = "Melakukan pembuatan tugas baru.";
        $dataLogs->save();

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
        $loggedInUser = Auth::user();

        $course = ModelCourse::find($course_id);

        $assignment = ModelAssignment::find($assignment_id);

        $studentAssignment = $assignment::select('assignments.id as assignment_student_id', 'assignments.title as assignment_title', 'users.id as user_id', 'users.name as user_name', 'user_assignments.student_id','user_assignments.id as user_assignments_id', 'user_assignments.status as file_status', 'user_assignments.file as file', 'user_assignments.grade', 'user_assignments.grader_id', 'user_assignments.examine_time', 'user_assignments.is_graded')
                                                    ->join('user_assignments', 'assignments.id', '=', 'user_assignments.assignment_id')
                                                    ->join('users', 'users.id', '=', 'user_assignments.student_id')
                                                    ->where('user_assignments.assignment_id', '=', $assignment_id)
                                                    ->where('user_assignments.student_id', '=', $loggedInUser->id)
                                                    ->first();
        $fileTokensStudent = explode('/', $studentAssignment->file);
        $fileShortStudent = $fileTokensStudent[sizeof($fileTokensStudent) - 1];
        $studentAssignment->file =  $fileShortStudent;

        $willBeGradedAssignments = $assignment::select('assignments.id as assignment_student_id', 'assignments.title as assignment_title', 'users.id as user_id', 'users.name as user_name', 'user_assignments.student_id','user_assignments.id as user_assignments_id', 'user_assignments.status as file_status', 'user_assignments.file as file', 'user_assignments.grade', 'user_assignments.grader_id', 'user_assignments.examine_time', 'user_assignments.is_graded')
                                            ->join('user_assignments', 'assignments.id', '=', 'user_assignments.assignment_id')
                                            ->join('users', 'users.id', '=', 'user_assignments.student_id')
                                            ->where('user_assignments.assignment_id', '=', $assignment_id)
                                            ->get(); 
        $fileShortGrader = array();
        foreach($willBeGradedAssignments as $willBeGradedAssignment) {
            $fileTokensGrader = [
                                    explode('/', $willBeGradedAssignment->file)
                                ];
            $fileShortGrader = [
                                    $fileTokensGrader[sizeof($fileTokensGrader) - 1]
                                ];
            $willBeGradedAssignments->file =  $fileShortGrader;
        }                                    
        
        $dataLogs = new ModelLog();
        $dataLogs->created_by = Auth::user()->name;
        $dataLogs->user_level = Auth::user()->level;
        $dataLogs->user_ip = \Request::ip();
        $dataLogs->action = "Mengakses halaman show tugas.";
        $dataLogs->save();
        
        return view('assignments.show', ['course' => $course, 'assignment' => $assignment, 'studentAssignment' => $studentAssignment, 'fileShortGrader' => $fileShortGrader, 'willBeGradedAssignments' => $willBeGradedAssignments, 'fileShortStudent' => $fileShortStudent]);
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
        $lecturerAssignments = ModelAssignment::select('courses.id as course_id', 'courses.code as course_code','courses.name as course_name', 'assignments.*')
                                                    ->leftjoin('courses', 'assignments.course_id', '=', 'courses.id')
                                                    ->get()
                                                    ->sortBy('start_time');

        $dataLogs = new ModelLog();
        $dataLogs->created_by = Auth::user()->name;
        $dataLogs->user_level = Auth::user()->level;
        $dataLogs->user_ip = \Request::ip();
        $dataLogs->action = "Mengakses halaman edit tugas.";
        $dataLogs->save();

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

        $dataLogs = new ModelLog();
        $dataLogs->created_by = Auth::user()->name;
        $dataLogs->user_level = Auth::user()->level;
        $dataLogs->user_ip = \Request::ip();
        $dataLogs->action = "Mengubah detail tugas dengan id " . $id . ".";
        $dataLogs->save();

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

        $dataLogs = new ModelLog();
        $dataLogs->created_by = Auth::user()->name;
        $dataLogs->user_level = Auth::user()->level;
        $dataLogs->user_ip = \Request::ip();
        $dataLogs->action = "Menghapus tugas dengan id " . $id . ".";
        $dataLogs->save();
           
        return redirect('/')->with('alert-success','Tugas berhasil dihapus');
    }
}
