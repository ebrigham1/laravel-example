<?php

namespace App\Http\Controllers\Sales;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SalesController extends Controller
{
    /**
     * Show sales dashboard
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('sales.home');
    }
    /**
     * Show sales report
     *
     * @return \Illuminate\Http\Response
     */
    public function report()
    {
        return view('sales.report');
    }
}
