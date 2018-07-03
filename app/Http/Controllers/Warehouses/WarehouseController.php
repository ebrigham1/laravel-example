<?php

namespace App\Http\Controllers\Warehouses;

use App\Http\Controllers\Controller;
use App\Models\Label;
use App\Models\Warehouse;
use Config;
use Illuminate\Http\Request;
use Response;
use Session;

class WarehouseController extends Controller
{
    /**
     * Display a listing of warehouses.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $warehouses = Warehouse::orderBy('name')->paginate(Config::get('app.perPage'));
        return view('warehouses.index', compact('warehouses'));
    }

    /**
     * Show the form for creating a new warehouse.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('warehouses.create');
    }

    /**
     * Store a newly created warehouse in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the new warehouse
        $this->validate($request, [
            'name' => 'required|unique:warehouses|max:255',
        ]);
        // Store the new warehouse
        $warehouse = Warehouse::create($request->all());
        // Redirect and let the user know of the success
        Session::flash('success', 'Successfully created warehouse "' . $warehouse->name . '"');
        return redirect()->route('warehouses.index');
    }

    /**
     * Display the specified warehouse.
     *
     * @param  \App\Models\Warehouse $warehouse
     * @return \Illuminate\Http\Response
     */
    public function show(Warehouse $warehouse)
    {
        return view('warehouses.show', compact('warehouse'));
    }

    /**
     * Show the form for editing the specified warehouse.
     *
     * @param  \App\Models\Warehouse $warehouse
     * @return \Illuminate\Http\Response
     */
    public function edit(Warehouse $warehouse)
    {
        return view('warehouses.edit', compact('warehouse'));
    }

    /**
     * Update the specified warehouse in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Warehouse $warehouse
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Warehouse $warehouse)
    {
        // Validate the new warehouse
        $this->validate($request, [
            'name' => 'required|unique:warehouses,name,' . $warehouse->id,
        ]);
        // Update the warehouse
        $warehouse->update($request->all());
        // Redirect and let the user know of the success
        Session::flash('success', 'Successfully updated warehouse "' . $warehouse->name . '"');
        return redirect()->route('warehouses.show', ['warehouse' => $warehouse]);
    }

    /**
     * Remove the specified warehouse from storage.
     *
     * @param Warehouse $warehouse
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Warehouse $warehouse)
    {
        // Delete the warehouse
        $warehouse->delete();
        // Redirect and let the user know of the success
        Session::flash('success', 'Successfully deleted warehouse "' . $warehouse->name . '"');
        return redirect()->route('warehouses.index');
    }

    /**
     * Get warehouses that match the term given
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function indexAjax(Request $request)
    {
        $warehouses = Warehouse::where('id', '!=', $request->input('notWarehouse', ''))
            ->where('name', 'like', '%' . $request->input('term') . '%')
            ->orderBy('name')->paginate(30);
        return Response::json($warehouses);
    }

    /**
     * Print a label for the specified warehouse.
     *
     * @param Warehouse $warehouse
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function print(Warehouse $warehouse)
    {
        $label = $warehouse->labels()->first();
        if (!$label instanceof Label) {
            $label = $warehouse->labels()->create();
        }
        if ($label->print()) {
            Session::flash('success', 'Successfully printed warehouse label');
        } else {
            Session::flash('error', 'Error printing warehouse label');
        }
        return redirect()->route('warehouses.show', ['warehouse' => $warehouse]);
    }

    /**
     * Show sections for the given warehouse
     *
     * @param \App\Models\Warehouse $warehouse
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function sections(Warehouse $warehouse)
    {
        $sections = $warehouse->sections;
        return view('warehouses.sections', compact('warehouse', 'sections'));
    }
}
