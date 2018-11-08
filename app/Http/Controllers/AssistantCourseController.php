<?php

namespace App\Http\Controllers;

use App\ModelUser;
use App\ModelCourse;
use App\ModelAssitantCourse;
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
            'assistant_name' => 'required',
            'course_name' => 'required',
        ]);
        $data = new ModelAssistantCourse();
        $data->assistant_name = $request->assistant_name;
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
        $assistantCourses = ModelAssistantCourse::find($id);

        return view('assistant_courses.show', compact('assistantCourses'));
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
            'assistant_name' => 'required',
            'course_name' => 'required',
        ]);
        $data = ModelAssistantCourse::find($id);
        $data->assistant_name = $request->assistant_name;
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
            $assistantCourses = ModelAssistantCourse::find($id);
            $assistantCourses->delete();
           
            return redirect('/')->with('alert-success','Berhasil dihapus');
    }
}
