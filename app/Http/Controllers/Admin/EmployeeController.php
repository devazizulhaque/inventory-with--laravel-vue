<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    // public function __construct()
    // {
    //     // $this->middleware('auth:api', ['except' => ['login', 'register']]);
    //     $this->middleware('JWT', ['except' => ['index', 'show']]);
    // }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = User::where('role_type', 2)->orderBy('created_at', 'desc')->get();
        return response()->json($employees);
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
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|unique:users,phone',
            'address' => 'required',
            'password' => 'required|confirmed|min:6',
            'newPhoto' => 'required',
        ]);
        $user = User::employeeCreateOrUpdate($request);
        return response()->json([
            'success' => true,
            'message' => 'Employee created successfully',
            'user' => $user
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $employee = User::find($id);
        return response()->json($employee);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $employee = User::find($id);
        return response()->json($employee);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'name' => 'required|string|min:3|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'phone' => 'required|unique:users,phone,' . $id,
            'address' => 'required',
            'photo' => 'nullable',
        ]);
        $user = User::employeeCreateOrUpdate($request, $id);
        return response()->json([
            'success' => true,
            'message' => 'Employee updated successfully',
            'user' => $user
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        User::find($id)->delete();
        return response()->json([
            'success' => true,
            'message' => 'Employee deleted successfully'
        ], 200);
    }
}
