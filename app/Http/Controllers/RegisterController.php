<?php

namespace App\Http\Controllers;

Use Auth;
use App\ModelLog;
use App\ModelUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class RegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userAssistant = ModelUser::where('level', '=', 'Assistant')->take(5)->latest()->get();
        $userLecturer = ModelUser::where('level', '=', 'Lecturer')->take(5)->latest()->get();
        $userStudent = ModelUser::where('level', '=', 'Student')->take(5)->latest()->get();
        $userAdmin = ModelUser::where('level', '=', 'Admin')->take(5)->latest()->get();

        $dataLogs = new ModelLog();
        $dataLogs->created_by = Auth::user()->name;
        $dataLogs->user_level = Auth::user()->level;
        $dataLogs->method = "GET";
        $dataLogs->action = "Mengakses halaman index pengguna milik tata usaha.";
        $dataLogs->save();

        return view('users.index', ['userAssistant' => $userAssistant, 'userLecturer' => $userLecturer, 'userStudent' => $userStudent, 'userAdmin' => $userAdmin]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $dataLogs = new ModelLog();
        $dataLogs->created_by = Auth::user()->name;
        $dataLogs->user_level = Auth::user()->level;
        $dataLogs->method = "GET";
        $dataLogs->action = "Mengakses halaman create pengguna milik tata usaha.";
        $dataLogs->save();

        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:4',
            'email' => 'required|email|unique:users|min:4',
            'password' => 'required',
            'conf_password' => 'required|same:password',
            'level' => 'required',
            'phone_number' => 'required',
            'address' => 'required',
            'birth_date' => 'required|date',
            'sex' => 'required',
        ]);
        $data = new ModelUser();
        $data->name = $request->name;
        $data->npm = $request->npm;
        $data->nik = $request->nik;
        $data->email = $request->email;
        $data->password = bcrypt($request->password);
        $data->level = $request->level;
        $data->phone_number = $request->phone_number;
        $data->address = $request->address;
        $data->sex = $request->sex;
        $data->birth_date = $request->birth_date;
        $data->save();

        $dataLogs = new ModelLog();
        $dataLogs->created_by = Auth::user()->name;
        $dataLogs->user_level = Auth::user()->level;
        $dataLogs->method = "POST";
        $dataLogs->action = "Membuat pengguna baru bernama " . $data->name . ".";
        $dataLogs->save();

        return redirect('/')->with('alert-success','Berhasil registrasi pengguna baru');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = ModelUser::find($id);

        $dataLogs = new ModelLog();
        $dataLogs->created_by = Auth::user()->name;
        $dataLogs->user_level = Auth::user()->level;
        $dataLogs->method = "GET";
        $dataLogs->action = "Mengakses halaman show pengguna milik tata usaha.";
        $dataLogs->save();
        
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = ModelUser::find($id);

        $dataLogs = new ModelLog();
        $dataLogs->created_by = Auth::user()->name;
        $dataLogs->user_level = Auth::user()->level;
        $dataLogs->method = "GET";
        $dataLogs->action = "Mengakses halaman edit pengguna milik tata usaha.";
        $dataLogs->save();

        return view('users.edit', compact('user'));
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
            'name' => 'required|min:4',
            'email' => 'required|email',
            'password' => 'required',
            'conf_password' => 'required|same:password',
            'level' => 'required',
            'phone_number' => 'required',
            'address' => 'required',
            'birth_date' => 'required|date',
            'sex' => 'required',
        ]);
        $data = ModelUser::find($id);
        $data->name = $request->name;
        $data->npm = $request->npm;
        $data->nik = $request->nik;
        $data->email = $request->email;
        $data->password = bcrypt($request->password);
        $data->level = $request->level;
        $data->phone_number = $request->phone_number;
        $data->address = $request->address;
        $data->sex = $request->sex;
        $data->birth_date = $request->birth_date;
        $data->save();

        $dataLogs = new ModelLog();
        $dataLogs->created_by = Auth::user()->name;
        $dataLogs->user_level = Auth::user()->level;
        $dataLogs->method = "PATCH";
        $dataLogs->action = "Mengubah detail pengguna dengan id " . $id . ".";
        $dataLogs->save();

        return redirect('/')->with('alert-success','Berhasil mengubah detail pengguna');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = ModelUser::find($id);
        $user->delete();

        $dataLogs = new ModelLog();
        $dataLogs->created_by = Auth::user()->name;
        $dataLogs->user_level = Auth::user()->level;
        $dataLogs->method = "DESTROY";
        $dataLogs->action = "Menghapus pengguna dengan id " . $id . ".";
        $dataLogs->save();
           
        return redirect('/')->with('alert-success','Berhasil dihapus');
    }
}
