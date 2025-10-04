<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Database\Seeders\UserSeeder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/test', function () {
    return response()->json(['message' => 'API is working!']);
});

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/users', [UserController::class, 'store']);

Route::post('/seed/users', function () {
    Artisan::call('db:seed', [
        '--class' => UserSeeder::class,
        '--force' => true,
    ]);

    return response()->json([
        'message' => 'UserSeeder executed successfully.',
        'ran' => true,
    ]);
});
