<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(): JsonResponse
    {
        $users = User::select([
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
        ])->orderBy('last_name')->get();

        return response()->json([
            'count' => $users->count(),
            'data' => $users,
        ], 200, [], JSON_PRETTY_PRINT);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'mobile_number' => ['required', 'string', 'max:20'],
            'age' => ['required', 'integer', 'min:0'],
            'address' => ['required', 'string'],
            'role' => ['required', 'in:admin,user'],
            'password' => ['required', 'string', 'min:8'],
            'profile_picture' => ['nullable', 'string'],
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
            'message' => 'User created successfully.',
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
    public function show(int $id): JsonResponse {
        $user = User::select([
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
        ])->findOrFail($id);

        return response()->json($user); 
    }
    public function destroy(int $id): JsonResponse {
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json([
            'message' => 'User deleted successfully.',
        ]);
    }
}
