<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CoursesController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('register', [AuthController::class, 'Register']);
Route::post('login', [AuthController::class, 'Login']);
Route::middleware('auth:sanctum')->post('logout', [AuthController::class, 'Logout']);

Route::middleware(['auth:sanctum', 'update.last_used'])->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::get('/courses', [CoursesController::class, 'index']);
    Route::post('/courses', [CoursesController::class, 'store']);
    Route::get('/courses/{courses}', [CoursesController::class, 'show']);
    Route::post('/courses/{courses}', [CoursesController::class, 'update']);
    Route::delete('/courses/{courses}', [CoursesController::class, 'destroy']);
});
