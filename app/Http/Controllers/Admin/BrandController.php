<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
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
        $brands = Brand::orderBy('created_at', 'desc')->get();
        return response()->json($brands);
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
            'name' => 'required|string|min:3|max:255|unique:brands,name',
            'newPhoto' => 'required',
        ]);
        $brand = Brand::CreateOrUpdate($request);
        return response()->json([
            'success' => true,
            'message' => 'Brand created successfully...',
            'brand' => $brand
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $brands = Brand::find($id);
        return response()->json($brands);
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
            'name' => 'required|string|min:3|max:255|unique:brands,name,' . $id,
        ]);
        $brand = Brand::CreateOrUpdate($request, $id);
        return response()->json([
            'success' => true,
            'message' => 'Brand updated successfully...',
            'brand' => $brand
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $brand = Brand::find($id)->delete();
        return response()->json([
            'success' => true,
            'message' => 'Brand deleted successfully...',
        ], 201);
    }
}
