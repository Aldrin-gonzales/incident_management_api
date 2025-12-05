<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function register(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'mobile_number' => 'required|string|max:20',
            'age' => 'required|integer|min:0',
            'address' => 'required|string',
            'role' => 'required|string|in:admin,user',
            'password' => 'required|string|min:8',
            'profile_picture' => 'nullable|string',
        ]);

        $user = User::create([
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'email' => $validated['email'],
            'mobile_number' => $validated['mobile_number'],
            'age' => $validated['age'],
            'address' => $validated['address'],
            'role' => $validated['role'],
            'password' => Hash::make($validated['password']),
            'profile_picture' => $validated['profile_picture'] ?? null,
        ]);

        return response()->json([
            'message' => 'User registered successfully.',
            'data' => $user->only([
                'id',
                'first_name',
                'last_name',
                'email',
                'mobile_number',
                'age',
                'address',
                'role',
                'profile_picture',
                'created_at',
                'updated_at',
            ]),
        ], 201, [], JSON_PRETTY_PRINT);
    }
    public function login(Request $request)
{
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required|string',
    ]);

    if (!auth()->attempt($credentials)) {
        return response()->json([
            'message' => 'Invalid credentials'
        ], 401);
    }

    $user = User::where('email', $request->email)->first();
    $token = $user->createToken('auth-token')->plainTextToken;

    return response()->json([
        'message' => 'Successfully logged in',
        'token' => $token,
        'user' => $user->only([
            'id',
            'first_name',
            'last_name',
            'email',
            'mobile_number',
            'age',
            'address',
            'role',
            'profile_picture',
        ])
    ]);
}
}