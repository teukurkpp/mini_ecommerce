<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * @group Authentication
     *
     * Register User
     *
     * Endpoint untuk membuat akun baru.
     *
     * @bodyParam name string required Nama user. Example: Budi
     * @bodyParam email string required Email user. Example: budi@gmail.com
     * @bodyParam password string required Password user. Example: password
     *
     * @response 200 {
     *   "message":"Register Success"
     * }
     */
    public function register(Request $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        return response()->json([
            'message' => 'Register Success'
        ]);
    }

    /**
     * @group Authentication
     *
     * Login User
     *
     * Login dan mendapatkan token Sanctum.
     *
     * @bodyParam email string required Email user. Example: admin@gmail.com
     * @bodyParam password string required Password user. Example: password
     *
     * @response 200 {
     *   "token":"1|abcdefg123456"
     * }
     */
    public function login(Request $request)
    {
        if (!Auth::attempt($request->only('email','password'))) {
            return response()->json([
                'message' => 'Unauthorized'
            ],401);
        }

        $user = Auth::user();

        $token = $user->createToken('api-token')->plainTextToken;

        return response()->json([
            'token' => $token
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Logout Success'
        ]);
    }
}
