<?php

namespace App\Http\Controllers\Api;

use App\Models\Assignments;
use App\Models\Submissions;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class AssignmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Assignments::with('courses:id,name')->get();
        return response()->json($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'course_id' => 'required|exists:courses,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'deadline' => 'required|date',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi Kesalahan',
                'data' => $validator->errors(),
            ], 400);
        }

        $input = $validator->validated();
        $date = explode('/', $input['deadline']);
        $input['deadline'] = $date[2] . '-' . $date[0] . '-' . $date[1];

        Assignments::create($input);

        return response()->json([
            'success' => true,
            'message' => 'Data Tugas Mata Kuliah Berhasil Ditambahkan',
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Assignments $assignments)
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
    public function destroy(Assignments $assignments)
    {
        $assignments->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data Tugas Mata Kuliah Berhasil Dihapus.',
        ]);
    }

    public function submissions_students(Assignments $assignments)
    {
        $data = $assignments->load(['submissions.student:id,name,email']);
        return response()->json($data);
    }

    public function download(Submissions $submissions)
    {
        $file = $submissions->file_path;

        $passphrase = 's3cret-3-L34rn1ng';
        $expiryTime = time() + (5);

        $data = json_encode(array(
            'file' => $file,
            'expiry_time' => $expiryTime,
        ));

        $iv = openssl_random_pseudo_bytes(16);

        $encryptedData = openssl_encrypt($data, 'aes-256-cbc', $passphrase, OPENSSL_RAW_DATA, $iv);
        $link_file = base64_encode($iv . $encryptedData);

        if ($encryptedData) {
            return response()->json([
                'success' => true,
                'file' => $link_file,
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi Kesalahan',
            ], 400);
        }
    }
}
