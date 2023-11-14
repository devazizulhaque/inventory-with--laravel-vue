<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Unit;
use Illuminate\Http\Request;

class UnitController extends Controller
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
        $units = Unit::orderBy('created_at', 'desc')->get();
        return response()->json($units);
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
            'name' => 'required|string|min:3|max:255|unique:units,name',
            'short_name' => 'required|string|min:1|max:255|unique:units,short_name',
        ]);
        $unit = Unit::CreateOrUpdate($request);
        return response()->json([
            'success' => true,
            'message' => 'Unit created successfully...',
            'unit' => $unit
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $units = Unit::find($id);
        return response()->json($units);
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
            'name' => 'required|string|min:3|max:255|unique:units,name,' . $id,
            'short_name' => 'required|string|min:1|max:255|unique:units,short_name,' . $id,
        ]);
        $unit = Unit::CreateOrUpdate($request, $id);
        return response()->json([
            'success' => true,
            'message' => 'Unit updated successfully...',
            'unit' => $unit
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $unit = Unit::find($id)->delete();
        return response()->json([
            'success' => true,
            'message' => 'Unit deleted successfully...',
        ], 200);
    }
}
