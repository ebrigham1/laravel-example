<?php

namespace App\Http\Controllers\Locations;

use App\Http\Controllers\Controller;
use App\Models\Location;
use Config;
use Illuminate\Http\Request;
use Session;

class LocationController extends Controller
{
    /**
     * Display a listing of locations.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $locations = Location::orderBy('name')->paginate(Config::get('app.perPage'));
        return view('locations.index', compact('locations'));
    }

    /**
     * Show the form for creating a new location.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('locations.create');
    }

    /**
     * Store a newly created location in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the new location
        $this->validate($request, [
            'name' => 'required|unique:locations|max:255',
        ]);
        // Store the new location
        $location = Location::create($request->all());
        // Redirect and let the user know of the success
        Session::flash('success', 'Successfully created location "' . $location->name . '"');
        return redirect()->route('locations.index');
    }

    /**
     * Display the specified location.
     *
     * @param  \App\Models\Location $location
     * @return \Illuminate\Http\Response
     */
    public function show(Location $location)
    {
        return view('locations.show', compact('location'));
    }

    /**
     * Show the form for editing the specified location.
     *
     * @param  \App\Models\Location $location
     * @return \Illuminate\Http\Response
     */
    public function edit(Location $location)
    {
        return view('locations.edit', compact('location'));
    }

    /**
     * Update the specified location in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Location $location
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Location $location)
    {
        // Validate the new location
        $this->validate($request, [
            'name' => 'required|unique:locations,name,' . $location->id,
        ]);
        // Update the location
        $location->update($request->all());
        // Redirect and let the user know of the success
        Session::flash('success', 'Successfully updated location "' . $location->name . '"');
        return redirect()->route('locations.show', ['location' => $location]);
    }

    /**
     * Remove the specified location from storage.
     *
     * @param Location $location
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Location $location)
    {
        // Delete the location
        $location->delete();
        // Redirect and let the user know of the success
        Session::flash('success', 'Successfully deleted location "' . $location->name . '"');
        return redirect()->route('locations.index');
    }
}
