<?php

namespace App\Http\Controllers\Warehouse;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;

class WarehouseController extends Controller
{
    /**
     * Show ledger dashboard
     *
     * @return \Illuminate\Http\Response
     */
    public function form()
    {
        return view('warehouse.form');
    }
    /**
     * Show ledger dashboard
     *
     * @return \Illuminate\Http\Response
     */
    public function formSubmit(Request $request)
    {
        // Do something with pick list
        // Validate the new role
        $this->validate($request, [
            'pickList' => 'required',
        ]);
        // Report success
        // Redirect and let the user know of the success
        Session::flash('success', 'Successfully submitted pick list "' . $request->input('pickList') . '"');
        return redirect()->route('warehouseForm');
    }
}
