<?php

namespace App\Http\Controllers;

use Auth;
use App\ModelLog;
use App\ModelUser;
use App\ModelCourse;
use App\ModelAssignment;
use App\ModelUserAssignment;
use App\ModelStudentCourse;
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
            'lecturer_id' => 'required',
            'course_id' => 'required',
        ]);
        $data = new ModelLecturerCourse();
        $data->lecturer_id = $request->lecturer_id;
        $data->course_id = $request->course_id;
        $data->save();

        $dataLogs = new ModelLog();
        $dataLogs->created_by = Auth::user()->name;
        $dataLogs->user_level = Auth::user()->level;
        $dataLogs->user_ip = \Request::ip();
        $dataLogs->action = "Melakukan penugasan terhadap dosen dengan id " . $data->lecturer_id . " dan mata kuliah dengan id " . $data->course_id . ".";
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
        $lecturerAssignments = ModelAssignment::select('assignments.*')
                                                    ->leftjoin('courses', 'assignments.course_id', '=', 'courses.id')
                                                    ->where('course_id', '=', $course->id)
                                                    ->get();

        $idAssignments = $lecturerAssignments->pluck('id');
        
        $index = 0;
        foreach ($idAssignments as $idAssignment) {
            $submittedStudents = ModelUserAssignment::select('user_assignments.*')
            ->join('assignments', 'user_assignments.assignment_id', '=', 'assignments.id')
            ->where('assignments.course_id', '=', $course->id)
            ->where('assignments.id', '=', $idAssignment )
            ->get()
            ->count();
            
            $lecturerAssignments[$index]->numberOfSubmittedUser = $submittedStudents;
            $index = $index+1;
        }
        
        $sizeOfStudents = $course::join('student_courses', 'courses.id', '=', 'student_courses.course_id')
                                    ->where('student_courses.course_id', '=', $course->id)
                                    ->get()
                                    ->count();

        $dataLogs = new ModelLog();
        $dataLogs->created_by = Auth::user()->name;
        $dataLogs->user_level = Auth::user()->level;
        $dataLogs->user_ip = \Request::ip();
        $dataLogs->action = "Mengakses halaman show course milik dosen.";
        $dataLogs->save();

        return view('lecturer_courses.show', compact('lecturerAssignments', 'course', 'sizeOfStudents', 'submittedStudents'));
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

            $dataLogs = new ModelLog();
            $dataLogs->created_by = Auth::user()->name;
            $dataLogs->user_level = Auth::user()->level;
            $dataLogs->user_ip = \Request::ip();
            $dataLogs->action = "Melakukan penghapusan penugasan terhadap dosen dengan id " . $id . ".";
            $dataLogs->save();
           
            return redirect('/')->with('alert-success','Berhasil dihapus');
    }
}