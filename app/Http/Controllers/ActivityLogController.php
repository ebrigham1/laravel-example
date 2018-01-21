<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Config;
use Response;

class ActivityLogController extends Controller
{
    /**
     * Display a listing of site activity.
     *
     * @return \Illuminate\Http\Response
     */
    public function mostRecent()
    {
        $activityLogs = ActivityLog::latest()->paginate(Config::get('app.perPage'));
        return view('mostRecentActivities', compact('activityLogs'));
    }

    /**
     * Display a listing of site activity via ajax.
     *
     * @return \Illuminate\Http\Response
     */
    public function mostRecentAjax()
    {
        $activityLogs = ActivityLog::latest()->paginate(Config::get('app.perPage'));
        return Response::json($activityLogs);
    }
}
