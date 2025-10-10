<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\IncidentTypeController;
use App\Http\Controllers\IncidentController;
use App\Models\User;
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
Route::get('/users/{id}', [UserController::class, 'show']);
Route::put('/users/{id}', [UserController::class, 'update']);
Route::delete('/users/{id}', [UserController::class, 'destroy']);
Route::get('/users', [UserController::class, 'index']);
Route::post('/incident-types', [IncidentTypeController::class, 'store']);
Route::get('/incident-types', [IncidentTypeController::class, 'index']);
Route::get('/incident-types/{id}', [IncidentTypeController::class, 'show']);
Route::put('/incident-types/{id}', [IncidentTypeController::class, 'update']);
Route::delete('/incident-types/{id}', [IncidentTypeController::class, 'destroy']);
Route::post('/incidents', [IncidentController::class, 'store']);
Route::get('/incidents', [IncidentController::class, 'index']);
Route::get('/incidents/{id}', [IncidentController::class, 'show']);
Route::put('/incidents/{id}', [IncidentController::class, 'update']);
Route::delete('/incidents/{id}', [IncidentController::class, 'destroy']);
Route::get('/admin', [AuthController::class, 'admin']);

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
