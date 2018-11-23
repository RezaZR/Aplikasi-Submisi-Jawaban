<?php

namespace App\Http\Controllers;

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
        $logs = ModelLog::latest()->paginate(20);    
        
        return view('logs.index', ['logs' => $logs]);
    }
}
