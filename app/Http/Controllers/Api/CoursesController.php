<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Courses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CoursesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $user_id = auth()->user()->id;
        $data = Courses::with('lecturer:id,name')->get();
        return response()->json($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
        ]);


        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi Kesalahan',
                'data' => $validator->errors(),
            ], 400);
        }

        $input = $validator->validated();
        $input['lecturer_id'] = auth()->user()->id;

        Courses::create($input);

        return response()->json([
            'success' => true,
            'message' => 'Data Mata Kuliah Berhasil Ditambahkan',
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Courses $courses)
    {
        return response()->json($courses);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Courses $courses)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
        ]);


        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi Kesalahan',
                'data' => $validator->errors(),
            ], 400);
        }

        $input = $validator->validated();

        $courses->update($input);

        return response()->json([
            'success' => true,
            'message' => 'Data Mata Kuliah Berhasil Diupdate',
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Courses $courses)
    {
        $courses->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data Mata Kuliah Berhasil Dihapus.',
        ]);
    }
}
