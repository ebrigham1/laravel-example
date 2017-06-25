<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutController extends Controller
{
    /**
     * Show about us page
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('about');
    }
}
