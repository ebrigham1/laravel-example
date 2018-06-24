<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use App\Models\Location;
use App\Models\Product;
use Config;
use Illuminate\Http\Request;
use Session;

class ProductController extends Controller
{
    /**
     * Display a listing of products.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::orderBy('name')->paginate(Config::get('app.perPage'));
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new product.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created product in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the new product
        $this->validate($request, [
            'name' => 'required|unique:products|max:255',
        ]);
        // Store the new product
        $product = Product::create($request->all());
        // Redirect and let the user know of the success
        Session::flash('success', 'Successfully created product "' . $product->name . '"');
        return redirect()->route('products.index');
    }

    /**
     * Display the specified product.
     *
     * @param  \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified product.
     *
     * @param  \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified product in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        // Validate the new product
        $this->validate($request, [
            'name' => 'required|unique:products,name,' . $product->id,
        ]);
        // Update the product
        $product->update($request->all());
        // Redirect and let the user know of the success
        Session::flash('success', 'Successfully updated product "' . $product->name . '"');
        return redirect()->route('products.show', ['product' => $product]);
    }

    /**
     * Remove the specified product from storage.
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Product $product)
    {
        // Delete the product
        $product->delete();
        // Redirect and let the user know of the success
        Session::flash('success', 'Successfully deleted product "' . $product->name . '"');
        return redirect()->route('products.index');
    }

    /**
     * Create labels for the given product
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeProductLabels(Request $request, Product $product)
    {
        // Validate the label creation
        $this->validate($request, [
            'number' => 'required|numeric|min:1|max:1000',
            'location' => 'required|exists:locations,id'
        ]);
        $product->createLabels($request->input('number'), Location::find($request->input('location')));
        // Redirect and let the user know of the success
        Session::flash(
            'success',
            'Successfully created ' . $request->input('number') . ' label(s)'
        );
        return redirect()->route('products.show', ['product' => $product]);
    }

    /**
     * Show locations for the given product
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function locations(Product $product)
    {
        $productLocations = $product->productLocations;
        dump($productLocations);
        return view('products.locations', compact('product', 'productLocations'));
    }
}
