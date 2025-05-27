<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Helpers\ResponseFormatter;


class UserController extends Controller
{
    public function register(Request $request)
    {
        try {
            // Validasi input
            $request->validate([
                'name'     => ['required', 'string', 'max:255'],
                'username' => ['required', 'string', 'max:255', 'unique:users,username'],
                'email'    => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
                'phone'    => ['required', 'string', 'max:20'],
                'password' => ['required', 'string', 'min:8'],
            ]);

            // Simpan user baru
            $user = User::create([
                'name'     => $request->name,
                'username' => $request->username,
                'email'    => $request->email,
                'phone'    => $request->phone,
                'password' => Hash::make($request->password),
            ]);

            // Buat token autentikasi
            $tokenResult = $user->createToken('authToken')->plainTextToken;

            return ResponseFormatter::success([
                'access_token' => $tokenResult,
                'token_type'   => 'Bearer',
                'user'         => $user,
            ], 'Registrasi Berhasil');
        } catch (Exception $error) {
            return ResponseFormatter::error([
                'message' => 'Registrasi gagal',
                'error'   => $error->getMessage(),
            ], 'Autentikasi gagal', 500);
        }
    }
}
