<?php

namespace App\Http\Controllers;

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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('registers.create');
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
        
        return view('registers.show', compact('user'));
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

        return view('registers.edit', compact('user'));
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
            'email' => 'required',
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
        return redirect('/')->with('alert-success','Berhasil registrasi pengguna baru');
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
           
        return redirect('/')->with('alert-success','Berhasil dihapus');
    }
}