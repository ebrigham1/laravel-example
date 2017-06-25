<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Show contact us page
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('contact');
    }
}
