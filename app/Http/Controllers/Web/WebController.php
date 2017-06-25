<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WebController extends Controller
{
    /**
     * Show web dashboard
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('web.home');
    }

    /**
     * Show web report
     *
     * @return \Illuminate\Http\Response
     */
    public function report()
    {
        return view('web.report');
    }
}
