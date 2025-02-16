<?php

namespace App\Http\Controllers\Api;

use App\Models\Materials;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MaterialStudentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user_id = auth()->user()->id;
        $data = Materials::whereHas('courses', function ($query) use ($user_id) {
            $query->whereHas('students', function ($query) use ($user_id) {
                $query->where('users.id', $user_id);
            });
        })->with('courses:id,name')->get();

        return response()->json($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
