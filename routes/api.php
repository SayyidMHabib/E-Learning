<?php

use App\Http\Controllers\Api\AssignmentsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FileController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CoursesController;
use App\Http\Controllers\Api\MaterialsController;
use App\Http\Controllers\Api\CourseStudentsController;
use App\Http\Controllers\Api\MaterialStudentsController;

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

    // route unduh file
    Route::get('/unduh', [FileController::class, 'unduh']);

    // Route Dosen
    // route mata kuliah dosen
    Route::get('/courses', [CoursesController::class, 'index']);
    Route::post('/courses', [CoursesController::class, 'store']);
    Route::get('/courses/{courses}', [CoursesController::class, 'show']);
    Route::post('/courses/{courses}', [CoursesController::class, 'update']);
    Route::delete('/courses/{courses}', [CoursesController::class, 'destroy']);
    Route::post('/mahasiswa_courses/{courses}', [CoursesController::class, 'mahasiswa_courses']);

    // route materi kuliah dosen
    Route::get('/materials', [MaterialsController::class, 'index']);
    Route::post('/materials', [MaterialsController::class, 'store']);
    Route::post('/materials/{materials}/download', [MaterialsController::class, 'download']);
    Route::delete('/materials/{materials}', [MaterialsController::class, 'destroy']);

    // route tugas kuliah dosen
    Route::get('/assignments', [AssignmentsController::class, 'index']);
    Route::post('/assignments', [AssignmentsController::class, 'store']);
    Route::delete('/assignments/{assignments}', [AssignmentsController::class, 'destroy']);


    // Route Mahasiswa
    // route mata kuliah mahasiswa
    Route::get('/course_students', [CourseStudentsController::class, 'index']);
    Route::get('/add_course_students', [CourseStudentsController::class, 'show']);
    Route::post('/add_course_students', [CourseStudentsController::class, 'store']);

    // route materi kuliah mahasiswa
    Route::get('/materialstudents', [MaterialStudentsController::class, 'index']);
});
