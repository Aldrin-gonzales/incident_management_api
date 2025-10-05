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

        if ($users->isNotEmpty()) {
            return response()->json([
                'status' => 'success',
                'count' => $users->count(),
                'data' => $users,
            ], 200, [], JSON_PRETTY_PRINT);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'No users found.',
            ], 404, [], JSON_PRETTY_PRINT);
        }
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

        if ($user) {
            return response()->json([
                'status' => 'success',
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
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to create user.',
            ], 500, [], JSON_PRETTY_PRINT);
        }
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

        if ($user) {
            return response()->json([
                'status' => 'success',
                'message' => 'User retrieved successfully.',
                'data' => $user,
            ], 200, [], JSON_PRETTY_PRINT); 
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'User not found.',
            ], 404, [], JSON_PRETTY_PRINT);
        } 
    }

    public function update(int $id, Request $request): JsonResponse {
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

        $user = User::find($id);

        if ($user) {
            $user->update($validated);
            return response()->json([
                'status' => 'success',
                'message' => 'User updated successfully.',
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
            ], 200, [], JSON_PRETTY_PRINT);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'User not found.',
            ], 404, [], JSON_PRETTY_PRINT);
        }
    }


    public function destroy(int $id): JsonResponse {
        $user = User::find($id);
        if ($user) {
            $user->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'User deleted successfully.',
            ], 200, [], JSON_PRETTY_PRINT);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'User not found.',
            ], 404, [], JSON_PRETTY_PRINT);
        }
    }
}
