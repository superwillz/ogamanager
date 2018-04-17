<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\ProductCategory;

class ProductsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::get();
        return view('products.all', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = ProductCategory::get();
        return view('products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $added_product = Product::create([
                                            'category_id' => $request->category,
                                            'name' => $request->name,
                                            'description' => $request->description,
                                            'manufacturer' => $request->manufacturer,
                                            'weight' => $request->weight,
                                            'colour' => $request->colour,
                                            'stock' => $request->stock,
                                            'last_updated_by' => auth()->user()->id,
                                        ]);
        if($added_product) {
            $request->session()->flash('success', 'Product Added to Inventory Successfully. <a href="/product/' . $added_product->id . '">View Product</a>');

            return redirect()->route('add_product');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted_product = Product::destroy($id);

        if($deleted_product) {
            request()->session()->flash('success', 'You deleted product <strong>#' . $id . '</strong>!');

            return redirect()->route('view_products');
        }
    }

    public function find(Request $request)
    {
        $product = "%$request->product_identity%";
        $products = Product::where('name', 'LIKE', $product)->get();
        
        if($products) {
            request()->session()->flash('success', 'Found Result for <strong>' . $request->product_identity . '</strong>!');
            return view('products.all', compact('products'));
        }
    }
}
