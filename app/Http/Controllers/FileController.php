<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function unduh(Request $request)
    {
        $link = $request->get('file');
        $passphrase = 's3cret-3-L34rn1ng';
        $file = $this->decryptDownloadLink($link, $passphrase);

        if ($file && Storage::disk('public')->exists($file)) {
            return Storage::disk('public')->download($file);
        }
    }

    private function decryptDownloadLink($encryptedLink, $passphrase)
    {
        $decodedData = base64_decode($encryptedLink);
        $iv = substr($decodedData, 0, 16);
        $encryptedData = substr($decodedData, 16);

        $decryptedData = openssl_decrypt($encryptedData, 'aes-256-cbc', $passphrase, OPENSSL_RAW_DATA, $iv);
        $decodedData = json_decode($decryptedData, true);

        if ($decodedData && isset($decodedData['expiry_time']) && $decodedData['expiry_time'] >= time()) {
            return $decodedData['file'];
        } else {
            return false;
        }
    }
}
