<?php

namespace App\Http\Controllers;

use App\Models\Label;

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
