<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
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
        $suppliers = Supplier::orderBy('created_at', 'desc')->get();
        return response()->json($suppliers);
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
            'name' => 'required|string|min:3|max:255',
            'email' => 'required|email|unique:suppliers,email',
            'phone' => 'required|unique:suppliers,phone',
            'address' => 'required',
            'shopname' => 'required',
            'newPhoto' => 'required',
        ]);
        $supplier = Supplier::CreateOrUpdate($request);
        return response()->json([
            'success' => true,
            'message' => 'Supplier created successfully',
            'supplier' => $supplier
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $supplier = Supplier::find($id);
        return response()->json($supplier);
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
            'name' => 'required|string|min:3|max:255',
            'email' => 'required|email|unique:suppliers,email,' . $id,
            'phone' => 'required|unique:suppliers,phone,' . $id,
            'address' => 'required',
            'shopname' => 'required',
        ]);
        $supplier = Supplier::CreateOrUpdate($request, $id);
        return response()->json([
            'success' => true,
            'message' => 'Supplier updated successfully',
            'supplier' => $supplier
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Supplier::find($id)->delete();
        return response()->json([
            'success' => true,
            'message' => 'Supplier deleted successfully...'
        ], 200);
    }
}
