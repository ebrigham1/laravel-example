<?php

namespace App\Http\Controllers\Warehouse;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WarehouseController extends Controller
{
    /**
     * Show ledger dashboard
     *
     * @return \Illuminate\Http\Response
     */
    public function form()
    {
        return view('warehouse.ledger');
    }
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
