<?php

namespace App\Http\Controllers;

use Auth;
use App\ModelLog;
use Illuminate\Http\Request;

class LogsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
        $logs = ModelLog::latest()->get();
        
        $dataLogs = new ModelLog();
        $dataLogs->created_by = Auth::user()->name;
        $dataLogs->user_level = Auth::user()->level;
        $dataLogs->user_ip = \Request::ip();
        $dataLogs->action = "Mengakses halaman index logs milik tata usaha.";
        $dataLogs->save();
        
        return view('logs.index', ['logs' => $logs]);
    }
}
