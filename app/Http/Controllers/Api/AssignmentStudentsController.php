<?php

namespace App\Http\Controllers\Api;

use App\Models\Assignments;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Submissions;
use Illuminate\Support\Facades\Validator;

class AssignmentStudentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user_id = auth()->user()->id;
        $data = Assignments::whereHas('courses', function ($query) use ($user_id) {
            $query->whereHas('students', function ($query) use ($user_id) {
                $query->where('users.id', $user_id);
            });
        })->with([
            'courses:id,name',
            'submissions' => function ($query) use ($user_id) {
                $query->where('student_id', $user_id);
            }
        ])->get();

        return response()->json($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'assignment_id' => 'required|exists:assignments,id',
            'file_path' => 'required|file'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi Kesalahan',
                'data' => $validator->errors(),
            ], 400);
        }

        $input = $validator->validated();
        $filePath = $request->file('file_path')->store('submissions', 'public');
        $input['file_path'] = $filePath;
        $input['student_id'] = auth()->user()->id;

        Submissions::create($input);

        return response()->json([
            'success' => true,
            'message' => 'Data Materi Kuliah Berhasil Ditambahkan',
        ], 201);
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
