<?php

namespace App\Http\Controllers;

use Auth;
use App\ModelUserAssignment;
use App\ModelAssignment;
use App\ModelCourse;
use App\ModelUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class StudentAssignmentController extends Controller
{
    var $file_name = "";

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($course_id, $assignment_id)
    { 
        $loggedInUser = Auth::user();
        $course = ModelCourse::find($course_id);
        $assignment = ModelAssignment::find($assignment_id);
        $studentAssignment = $assignment::select('assignments.id as assignment_student_id', 'users.id as user_id', 'user_assignments.student_id','user_assignments.id as user_assignments_id', 'user_assignments.status as file_status', 'user_assignments.file as file')
                                                    ->join('user_assignments', 'assignments.id', '=', 'user_assignments.assignment_id')
                                                    ->join('users', 'users.id', '=', 'user_assignments.student_id')
                                                    ->where('user_assignments.assignment_id', '=', $assignment_id)
                                                    // ->where('user_assignments.student_id', '=', 'users.id')
                                                    ->first();
        
        $file_tokens = explode('/', $studentAssignment->file);
        $studentAssignment->file = $file_tokens[sizeof($file_tokens) - 1];      
        
        return view('student_assignments.index', ['course' => $course, 'assignment' => $assignment, 'studentAssignment' => $studentAssignment]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($course_id, $assignment_id) {
        $loggedInUser = Auth::user();

        $course = ModelCourse::find($course_id);
        $assignment = ModelAssignment::find($assignment_id);
        $studentAssignments = ModelAssignment::select('courses.id as course_id', 'courses.code as course_code','courses.name as course_name', 'assignments.*')
                                                    ->leftjoin('courses', 'assignments.course_id', '=', 'courses.id')
                                                    ->get()
                                                    ->sortBy('start_time');

        return view('student_assignments.create', ['course' => $course, 'assignment' => $assignment, 'studentAssignments' => $studentAssignments]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $this->validate($request, [
            'assignment_id' => 'required',
            'student_id' => 'required',
            'file' => 'mimes:doc,docx,zip,rar,txt,pdf,image',
        ]);

        $data = new ModelUserAssignment();
        $data->assignment_id = $request->assignment_id;
        $data->student_id = $request->student_id;
        // $data->file = $request->file;
        $file = $request->file;
        $file->move('uploads', $file->getClientOriginalName());
        $data->file = public_path("uploads/" . $file->getClientOriginalName());
        $data->status = "Submitted";
        // \File::put(public_path() . '/' . $data->file, base64_decode($data->file));
        // if($data->file != "") {
        //     \Storage::disk('public')->put($data->file, base64_decode($data->file));     
        // }
        $data->save();

        return redirect('/')->with('alert-success','Berhasil mengumpulkan tugas');
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
        $studentAssignments = $assignment::select('courses.id as course_id', 'courses.code as course_code','courses.name as course_name', 'user_assignments.id', 'user_assignments.status as file_status', 'user_assignments.file as file', 'assignments.id as student_assignment_id')
                                                    ->leftjoin('courses', 'assignments.course_id', '=', 'courses.id')
                                                    ->leftjoin('user_assignments', 'assignments.id', '=', 'user_assignments.assignment_id')
                                                    ->where('user_assignments.assignment_id', '=', $assignment_id)
                                                    ->first();
        
        return view('student_assignments.edit', ['course' => $course, 'assignment' => $assignment, 'studentAssignments' => $studentAssignments]);
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
            'assignment_id' => 'required',
            'student_id' => 'required',
            'file' => 'mimes:doc,docx,zip,rar,txt,pdf,image',
        ]);

        // $file_name = $request->file;

        $data = ModelUserAssignment::find($user_assignment_id);
        $data->assignment_id = $request->assignment_id;
        $data->student_id = $request->student_id;
        // $data->file = $file_name;
        $file = $request->file;

        // $data->file->move('uploads', $data->file->getClientOriginalName());
        
        $file->move('uploads', $file->getClientOriginalName());
        $data->file = public_path("uploads/" . $file->getClientOriginalName());
        // $GLOBALS['file_name'] = explode('/', $data->file);
        // dd($GLOBALS['file_name'])
        // \File::put(public_path('document') . '/' . $data->file, base64_decode($data->file));

        // if($data->file != "") {
        //     \Storage::disk('public')->put($data->file, base64_decode($data->file));     
        // }
        $data->save();
        // dd($data);

        return redirect('/')->with('alert-success','Berhasil mengubah');
    }

    public function download() {
        return response()->download(public_path('uploads/Tugas Week 5.docx'));
    }
}
