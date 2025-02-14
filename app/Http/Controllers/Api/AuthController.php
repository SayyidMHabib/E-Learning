<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function Register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                'unique:users,email',
                'regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/'
            ],
            'password' => ['required', 'string', 'min:8'],
            'confirm_password' => ['required', 'string', 'min:8', 'same:password'],
            'level' => ['required', 'integer'],
        ]);


        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi Kesalahan',
                'data' => $validator->errors(),
            ]);
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);

        $success['email'] = $user->email;
        $success['name'] = $user->name;

        return response()->json([
            'success' => true,
            'message' => 'Register Berhasil',
            'data' => $success,
        ]);
    }

    public function Login(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $auth = Auth::user();
            $success['token'] =  $auth->createToken('auth_token')->plainTextToken;
            $success['name'] =  $auth->name;

            return response()->json([
                'success' => true,
                'message' => 'Login Berhasil',
                'data' => $success,
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Email atau Password salah',
            ]);
        }
    }

    public function Logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json([
            'success' => true,
            'message' => 'Logout Berhasil',
        ]);
    }
}
