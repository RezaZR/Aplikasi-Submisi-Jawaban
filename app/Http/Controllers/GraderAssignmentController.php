<?php

namespace App\Http\Controllers;

use Auth;
use Carbon\Carbon;
use App\ModelLog;
use App\ModelUserAssignment;
use App\ModelAssignment;
use App\ModelCourse;
use App\ModelUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class GraderAssignmentController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($course_id, $assignment_id, $user_assignment_id)
    { 
        $loggedInUser = Auth::user();

        $course = ModelCourse::find($course_id);
        $assignment = ModelAssignment::find($assignment_id);
        $studentAssignment = ModelUserAssignment::find($user_assignment_id);
        $graderAssignment = $studentAssignment::select('user_assignments.id', 'user_assignments.status as file_status', 'user_assignments.file as file', 'assignments.id as student_assignment_id')
                                                    ->leftjoin('user_assignments', 'assignments.id', '=', 'user_assignments.assignment_id')
                                                    ->leftjoin('users', 'users.id', '=', 'user_assignments.student_id')
                                                    ->where('user_assignments.assignment_id', '=', $assignment_id)
                                                    ->get();
        $file_tokens = explode('/', $studentAssignment->file);
        $studentAssignment->file = $file_tokens[sizeof($file_tokens) - 1];    
        
        $dataLogs = new ModelLog();
        $dataLogs->created_by = Auth::user()->name;
        $dataLogs->user_level = Auth::user()->level;
        $dataLogs->user_ip = \Request::ip();
        $dataLogs->action = "Mengakses halaman index penilaian.";
        $dataLogs->save();
        
        return view('student_assignments.index', ['course' => $course, 'assignment' => $assignment, 'studentAssignments' => $studentAssignment]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($course_id, $assignment_id, $user_assignment_id) {
        $loggedInUser = Auth::user();

        $course = ModelCourse::find($course_id);
        $assignment = ModelAssignment::find($assignment_id);
        $studentAssignment = ModelUserAssignment::find($user_assignment_id);
        $willBeGradedStudent = $studentAssignment::select('assignments.id as assignment_student_id', 'assignments.title as assignment_title', 'users.id as user_id', 'users.name as user_name', 'user_assignments.student_id','user_assignments.id as user_assignments_id', 'user_assignments.file as file')
                                                    ->join('assignments', 'assignments.id', '=', 'user_assignments.assignment_id')
                                                    ->join('users', 'users.id', '=', 'user_assignments.student_id')
                                                    ->where('user_assignments.assignment_id', '=', $assignment->id)
                                                    ->first();

        $fileTokens = explode('/', $willBeGradedStudent->file);
        $fileShort = $fileTokens[sizeof($fileTokens) - 1];
        $willBeGradedStudent->file = $fileShort;

        $dataLogs = new ModelLog();
        $dataLogs->created_by = Auth::user()->name;
        $dataLogs->user_level = Auth::user()->level;
        $dataLogs->user_ip = \Request::ip();
        $dataLogs->action = "Mengakses halaman create nilai.";
        $dataLogs->save();

        return view('grader_assignments.create', ['course' => $course, 'assignment' => $assignment, 'studentAssignments' => $studentAssignments, 'willBeGradedStudent' => $willBeGradedStudent, 'fileShort' => $fileShort]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $course_id, $assignment_id, $user_assignment_id) {
        $this->validate($request, [
            'grade' => 'required',
        ]);

        $data = ModelUserAssignment::find($user_assignment_id);
        $data->grader_id = Auth::user()->id;
        $data->examine_time = Carbon::now();
        $data->grade = (float) $request->grade;
        $data->is_graded = true;
        $data->save();

        $dataLogs = new ModelLog();
        $dataLogs->created_by = Auth::user()->name;
        $dataLogs->user_level = Auth::user()->level;
        $dataLogs->user_ip = \Request::ip();
        $dataLogs->action = "Memasukkan nilai terhadap tugas mahasiswa.";
        $dataLogs->save();

        return redirect('/')->with('alert-success','Berhasil menilai tugas');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($course_id, $assignment_id, $user_assignment_id)
    {
        $loggedInUser = Auth::user();

        $course = ModelCourse::find($course_id);
        $assignment = ModelAssignment::find($assignment_id);
        $studentAssignment = ModelUserAssignment::find($user_assignment_id);
        $willBeGradedStudent = $studentAssignment::select('assignments.id as assignment_student_id', 'assignments.title as assignment_title', 'users.id as user_id', 'users.name as user_name', 'user_assignments.student_id','user_assignments.id as user_assignments_id', 'user_assignments.file as file', 'user_assignments.grade')
                                                    ->join('assignments', 'assignments.id', '=', 'user_assignments.assignment_id')
                                                    ->join('users', 'users.id', '=', 'user_assignments.student_id')
                                                    ->where('user_assignments.assignment_id', '=', $assignment->id)
                                                    ->first();

        $fileTokens = explode('/', $willBeGradedStudent->file);
        $fileShort = $fileTokens[sizeof($fileTokens) - 1];
        $willBeGradedStudent->file = $fileShort;

        $dataLogs = new ModelLog();
        $dataLogs->created_by = Auth::user()->name;
        $dataLogs->user_level = Auth::user()->level;
        $dataLogs->user_ip = \Request::ip();
        $dataLogs->action = "Mengakses halaman edit nilai.";
        $dataLogs->save();

        return view('grader_assignments.edit', ['course' => $course, 'assignment' => $assignment, 'studentAssignments' => $studentAssignments, 'willBeGradedStudent' => $willBeGradedStudent, 'fileShort' => $fileShort]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $course_id, $assignment_id, $user_assignment_id)
    {
        $this->validate($request, [
            'grade' => 'required',
        ]);

        $data = ModelUserAssignment::find($user_assignment_id);
        $data->grader_id = Auth::user()->id;
        $data->examine_time = Carbon::now();
        $data->grade = (float) $request->grade;
        $data->is_graded = true;
        $data->save();

        $dataLogs = new ModelLog();
        $dataLogs->created_by = Auth::user()->name;
        $dataLogs->user_level = Auth::user()->level;
        $dataLogs->user_ip = \Request::ip();
        $dataLogs->action = "Mengubah detail nilai.";
        $dataLogs->save();

        return redirect('/')->with('alert-success','Berhasil mengubah nilai');
    }
}
