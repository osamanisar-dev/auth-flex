<?php

namespace App\Http\Controllers;

use App\Events\UserRegistered;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $user = User::create($request->validated());
        $token = $user->createToken('auth_token')->plainTextToken;
        event(new UserRegistered($user));
        return response()->json([
            'message' => "User registered successfully.\nEmail verification link sent to email",
            'token' => $token,
            'user' => $user->only([
                'id', 'name', 'email', 'email_verified_at', 'created_at', 'updated_at'
            ]),
        ], Response::HTTP_OK);
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('auth_token')->plainTextToken;
            return response()->json([
                'message' => 'LogIn Successfully',
                'user' => $user,
                'token' => $token
            ], Response::HTTP_OK);
        }
        return response()->json([
            'message' => 'Invalid credentials',
        ], Response::HTTP_UNAUTHORIZED);
    }

    public function logout(Request $request)
    {
        try {
            $request->user()->tokens()->delete();
            return response()->json([
                'message' => 'Logged out successfully',
            ], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Logout failed',
                'error' => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function verifyEmail(Request $request, $id, $hash)
    {
        $user = User::findOrFail($id);
        if (!URL::hasValidSignature($request)) {
            abort(401, 'Invalid or expired verification link.');
        }

        if (!hash_equals((string)$hash, sha1($user->email))) {
            abort(403, 'Invalid hash.');
        }
        if (!$user->email_verified_at) {
            $user->email_verified_at = now();
            $user->save();
        }

        return redirect()->to(config('app.frontend_url') . '?' . http_build_query([
                'verified' => '1',
                'id' => $user->id,
                'email_verified_at' => $user->email_verified_at->toISOString()
            ])
        );
    }
}
