<?php

namespace App\Http\Controllers;

use Auth;
use App\ModelLog;
use App\ModelCourse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
        $courses = ModelCourse::all();

        $dataLogs = new ModelLog();
        $dataLogs->created_by = Auth::user()->name;
        $dataLogs->user_level = Auth::user()->level;
        $dataLogs->user_ip = \Request::ip();
        $dataLogs->action = "Mengakses halaman index mata kuliah milik tata usaha.";
        $dataLogs->save();

        return view('courses.index', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $dataLogs = new ModelLog();
        $dataLogs->created_by = Auth::user()->name;
        $dataLogs->user_level = Auth::user()->level;
        $dataLogs->user_ip = \Request::ip();
        $dataLogs->action = "Mengakses halaman create mata kuliah milik tata usaha.";
        $dataLogs->save();

        return view('courses.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $this->validate($request, [
            'code' => 'required|unique:courses',
            'name' => 'required',
        ]);
        $data = new ModelCourse();
        $data->code = $request->code;
        $data->name = $request->name;
        $data->save();

        $dataLogs = new ModelLog();
        $dataLogs->created_by = Auth::user()->name;
        $dataLogs->user_level = Auth::user()->level;
        $dataLogs->user_ip = \Request::ip();
        $dataLogs->action = "Membuat mata kuliah baru bernama " . $data->name . ".";
        $dataLogs->save();

        return redirect('/')->with('alert-success','Berhasil membuat mata kuliah baru');
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

        $dataLogs = new ModelLog();
        $dataLogs->created_by = Auth::user()->name;
        $dataLogs->user_level = Auth::user()->level;
        $dataLogs->user_ip = \Request::ip();
        $dataLogs->action = "Mengakses halaman show mata kuliah milik tata usaha.";
        $dataLogs->save();

        return view('courses.show', compact('course'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $course = ModelCourse::find($id);

        $dataLogs = new ModelLog();
        $dataLogs->created_by = Auth::user()->name;
        $dataLogs->user_level = Auth::user()->level;
        $dataLogs->user_ip = \Request::ip();
        $dataLogs->action = "Mengakses halaman edit mata kuliah milik tata usaha.";
        $dataLogs->save();

        return view('courses.edit', compact('course'));
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
            'code' => 'required',
            'name' => 'required',
        ]);
        $data = ModelCourse::find($id);
        $data->code = $request->code;
        $data->name = $request->name;
        $data->save();

        $dataLogs = new ModelLog();
        $dataLogs->created_by = Auth::user()->name;
        $dataLogs->user_level = Auth::user()->level;
        $dataLogs->user_ip = \Request::ip();
        $dataLogs->action = "Mengubah detail mata kuliah dengan id " . $id . ".";
        $dataLogs->save();

        return redirect('/')->with('alert-success','Berhasil mengubah detail mata kuliah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $course = ModelCourse::find($id);
        $course->delete();

        $dataLogs = new ModelLog();
        $dataLogs->created_by = Auth::user()->name;
        $dataLogs->user_level = Auth::user()->level;
        $dataLogs->user_ip = \Request::ip();
        $dataLogs->action = "Menghapus mata kuliah dengan id " . $id . ".";
        $dataLogs->save();
           
        return redirect('/')->with('alert-success','Berhasil dihapus');
    }
}
