<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Helpers\ResponseFormatter;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function fetch(Request $request)
    {
        return ResponseFormatter::success($request->user(), 'Berhasil');
    }

    public function login(Request $request)
    {
        try {
            $request->validate([
                'username' => 'required',
                'password' => 'required'
            ]);

            $credentials = request(['username', 'password']);
            if (!Auth::attempt($credentials)) {
                return ResponseFormatter::error([
                    'message' => 'Unauthorized'
                ], 'Password atau Username salah', 500);
            }

            $user = User::where('username', $request->username)->first();
            if (!Hash::check($request->password, $user->password, [])) {
                throw new \Exception('Invalid Credentials');
            }

            $tokenResult = $user->createToken('authToken')->plainTextToken;

            return ResponseFormatter::success([
                'access_token' => $tokenResult,
                'token_type' => 'Bearer',
                'user' => $user
            ], 'Authenticated');
        } catch (Exception $error) {
            return ResponseFormatter::error([
                'message' => 'Something went wrong',
                'error'   => $error->getMessage(),
            ], 'Username atau Password salah', '500');
        }
    }

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

    public function updateProfile(Request $request)
    {
        $data = $request->all();

        $user = Auth::user();
        $user->update($data);

        return ResponseFormatter::success($user, 'Profile Updated');
    }

    public function logout(Request $request)
    {
        $revokeToken = $request->user()->currentAccessToken()->delete();

        return ResponseFormatter::success(
            $revokeToken,
            'Token Revoke'
        );
    }
}
