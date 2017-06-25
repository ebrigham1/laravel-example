<?php

namespace App\Http\Controllers\Finance;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LedgerController extends Controller
{
    /**
     * Show ledger dashboard
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('finance.ledger');
    }
}
