<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Materials;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class MaterialsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Materials::all();
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
        $filePath = $request->file('file_path')->store('materials', 'public');
        $input['file_path'] = $filePath;

        Materials::create($input);

        return response()->json([
            'success' => true,
            'message' => 'Data Materi Kuliah Berhasil Ditambahkan',
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Materials $materials)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Materials $materials)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Materials $materials)
    {
        $materials->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data Materi Kuliah Berhasil Dihapus.',
        ]);
    }

    public function download(Materials $materials)
    {
        $file = $materials->file_path;

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
