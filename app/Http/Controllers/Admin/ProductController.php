<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // public function __construct()
    // {
    //     // $this->middleware('auth:api', ['except' => ['login', 'register']]);
    //     $this->middleware('JWT', ['except' => ['index']]);
    // }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::orderBy('created_at', 'desc')->get();
        return response()->json($products);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'brand_id' => 'required|numeric',
            'category_id' => 'required|numeric',
            'unit_id' => 'required|numeric',
            'name' => 'required|string|min:3|max:255|unique:products,name',
            'sku' => 'required|unique:products,sku|min:3|max:8',
            'barcode' => 'required|unique:products,barcode|min:3|max:8',
            'alert_quantity' => 'required|numeric',
            'status' => 'required|numeric',
            'price' => 'required|numeric',
            'description' => 'required|string|min:3|max:255',
            'newPhoto' => 'required',
        ]);
        $product = Product::CreateOrUpdate($request);
        return response()->json([
            'success' => true,
            'message' => 'Product created successfully...',
            'product' => $product
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::find($id);
        return response()->json($product);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'brand_id' => 'required|numeric',
            'category_id' => 'required|numeric',
            'unit_id' => 'required|numeric',
            'name' => 'required|string|min:3|max:255|unique:products,name,' . $id,
            'sku' => 'required|unique:products,sku,' . $id . '|min:3|max:8',
            'barcode' => 'required|unique:products,barcode,' . $id . '|min:3|max:8',
            'alert_quantity' => 'required|numeric',
            'status' => 'required|numeric',
            'price' => 'required|numeric',
            'description' => 'required|string|min:3|max:255',
        ]);
        $product = Product::CreateOrUpdate($request, $id);
        return response()->json([
            'success' => true,
            'message' => 'Product updated successfully...',
            'product' => $product
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Product::find($id)->delete();
        return response()->json([
            'success' => true,
            'message' => 'Product deleted successfully...'
        ], 200);
    }
}
