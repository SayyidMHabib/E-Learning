<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Courses;
use App\Models\CourseStudents;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class CourseStudentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user_id = auth()->user()->id;

        $data = Courses::with('lecturer:id,name')
            ->whereHas('students', function ($query) use ($user_id) {
                $query->where('student_id', $user_id);
            })
            ->get();

        return response()->json($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'course_id' => ['required', 'array'],
            'course_id.*' => ['integer', 'exists:courses,id'],
        ]);


        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi Kesalahan',
                'data' => $validator->errors(),
            ], 400);
        }

        $input = $validator->validated();
        $user_id = auth()->user()->id;
        $course_id = $input['course_id'];

        $data = [];
        foreach ($course_id as $course) {
            $data[] = [
                'course_id' => $course,
                'student_id' => $user_id,
            ];
        }

        CourseStudents::insert($data);

        return response()->json([
            'success' => true,
            'message' => 'Data Mata Kuliah Berhasil Ditambahkan',
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $user_id = auth()->user()->id;

        $data = Courses::with('lecturer:id,name')
            ->whereDoesntHave('students', function ($query) use ($user_id) {
                $query->where('student_id', $user_id);
            })
            ->get();

        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CourseStudents $courseStudents)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CourseStudents $courseStudents)
    {
        //
    }
}
