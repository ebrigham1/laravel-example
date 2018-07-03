<?php

namespace App\Http\Controllers\Sections;

use App\Http\Controllers\Controller;
use App\Models\Label;
use App\Models\Product;
use App\Models\Section;
use App\Models\Warehouse;
use Config;
use Illuminate\Http\Request;
use Response;
use Session;

class SectionController extends Controller
{
    /**
     * Display a listing of sections.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sections = Section::orderBy('name')->paginate(Config::get('app.perPage'));
        return view('sections.index', compact('sections'));
    }

    /**
     * Show the form for creating a new section.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('sections.create');
    }

    /**
     * Store a newly created section in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the new section
        $this->validate($request, [
            'name' => 'required|unique:sections|max:255',
            'warehouse_id' => 'required|exists:warehouses,id',
        ]);
        // Store the new section
        $section = Section::create($request->all());
        // Redirect and let the user know of the success
        Session::flash('success', 'Successfully created section "' . $section->name . '"');
        return redirect()->route('sections.index');
    }

    /**
     * Display the specified section.
     *
     * @param  \App\Models\Section $section
     * @return \Illuminate\Http\Response
     */
    public function show(Section $section)
    {
        return view('sections.show', compact('section'));
    }

    /**
     * Show the form for editing the specified section.
     *
     * @param  \App\Models\Section $section
     * @return \Illuminate\Http\Response
     */
    public function edit(Section $section)
    {
        return view('sections.edit', compact('section'));
    }

    /**
     * Update the specified section in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Section $section
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Section $section)
    {
        // Validate the new section
        $this->validate($request, [
            'name' => 'required|unique:sections,name,' . $section->id,
            'warehouse_id' => 'required|exists:warehouses,id',
        ]);
        // Update the section
        $section->update($request->all());
        // Redirect and let the user know of the success
        Session::flash('success', 'Successfully updated section "' . $section->name . '"');
        return redirect()->route('sections.show', ['section' => $section]);
    }

    /**
     * Remove the specified section from storage.
     *
     * @param Section $section
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Section $section)
    {
        // Delete the section
        $section->delete();
        // Redirect and let the user know of the success
        Session::flash('success', 'Successfully deleted section "' . $section->name . '"');
        return redirect()->route('sections.index');
    }

    /**
     * Print a label for the specified section.
     *
     * @param Section $section
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function print(Section $section)
    {
        $label = $section->labels()->first();
        if (!$label instanceof Label) {
            $label = $section->labels()->create();
        }
        if ($label->print()) {
            Session::flash('success', 'Successfully printed section label');
        } else {
            Session::flash('error', 'Error printing section label');
        }
        return redirect()->route('sections.show', ['section' => $section]);
    }

    /**
     * Show locations for the given warehouse
     *
     * @param \App\Models\Section $section
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function locations(Section $section)
    {
        $locations = $section->locations;
        return view('sections.locations', compact('section', 'locations'));
    }

    /**
     * Get sections that match the term given
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function indexAjax(Request $request)
    {
        $sections = Section::where('id', '!=', $request->input('notSection', ''))
            ->where('name', 'like', '%' . $request->input('term') . '%')
            ->orderBy('name')->paginate(30);
        return Response::json($sections);
    }

    /**
     * Get given product sections for the given product in the given warehouse
     *
     * @param \App\Models\Product $product
     * @param \App\Models\Warehouse $warehouse
     * @return \Illuminate\Http\JsonResponse
     */
    public function productSectionAjax(Product $product, Warehouse $warehouse)
    {
        $productSections = $product->productSections()->whereHas('section', function ($query) use ($warehouse) {
            $query->where('warehouse_id', $warehouse->id);
        })->get();
        return Response::json($productSections);
    }
}
