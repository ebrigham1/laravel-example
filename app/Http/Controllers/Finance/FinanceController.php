<?php

namespace App\Http\Controllers\Finance;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FinanceController extends Controller
{
    /**
     * Show finance dashboard
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('finance.index');
    }
}
