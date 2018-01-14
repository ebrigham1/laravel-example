<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Config;

class ActivityLogController extends Controller
{
    /**
     * Display a listing of site activity.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $activityLogs = ActivityLog::orderBy('id', 'desc')->paginate(Config::get('app.perPage'));
        return view('activityLog', compact('activityLogs'));
    }
}
