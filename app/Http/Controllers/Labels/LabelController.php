<?php

namespace App\Http\Controllers\Labels;

use App\Http\Controllers\Controller;
use App\Models\Label;
use App\Models\Product;
use App\Models\Location;
use Illuminate\Http\Request;
use Response;
use Session;

class LabelController extends Controller
{
    /**
     * Get given product labels in the given location
     *
     * @param \App\Models\Product $product
     * @param \App\Models\Location $location
     * @return \Illuminate\Http\JsonResponse
     */
    public function productLocationAjax(Product $product, Location $location)
    {
        $labels = $product->labels()->where('location_id', $location->id)->with(['labelable', 'location'])->get();
        return Response::json($labels);
    }

    /**
     * Display the specified label.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Label $label
     * @return \Illuminate\Http\Response
     */
    public function move(Request $request, Label $label)
    {
        // Validate the move location
        $this->validate($request, [
            'location' => 'required|exists:locations,id'
        ]);
        $label->location_id = $request->input('location');
        $label->save();
        // Redirect and let the user know of the success
        Session::flash(
            'success',
            'Successfully moved label'
        );
        return redirect()->route('labels.show', ['label' => $label]);
    }

    /**
     * Display the specified label.
     *
     * @param  \App\Models\Label $label
     * @return \Illuminate\Http\Response
     */
    public function show(Label $label)
    {
        return view('labels.show', compact('label'));
    }

    /**
     * Remove the specified label from storage.
     *
     * @param \App\Models\Label $label
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Label $label)
    {
        // Delete the label
        $label->delete();
        // Redirect and let the user know of the success
        Session::flash('success', 'Successfully deleted label "' . $label->id . '"');
        return redirect()->route('home');
    }
}
