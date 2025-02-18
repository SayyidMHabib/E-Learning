<?php

use App\Models\User;
use App\Models\Courses;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
})->middleware('guest');

Route::get('/login', function () {
    return view('auth.login', [
        'title' => 'Login',
    ]);
})->name('login')->middleware('guest');

Route::get('/register', function () {
    return view('auth.register', [
        'title' => 'Login',
    ]);
})->name('register')->middleware('guest');

Route::middleware(['auth:sanctum', 'update.last_used'])->group(function () {
    Route::get('/dashboard', function (Request $request) {
        return view('index', [
            'title' => 'Dashboard',
            'active' => 'dashboard',
            'count_courses' => Courses::all()->count(),
            'count_lecturers' => User::where('level', 1)->count(),
            'count_students' => User::where('level', 2)->count()
        ]);
    });

    // route dosen
    Route::get('/courses', function (Request $request) {
        return view('courses', [
            'title' => 'Mata Kuliah',
            'active' => 'courses'
        ]);
    });
    Route::get('/materials', function (Request $request) {
        return view('materials', [
            'title' => 'Materi Kuliah',
            'active' => 'materials',
            'courses' => Courses::where('lecturer_id', auth()->user()->id)->get(),
        ]);
    });
    Route::get('/assignments', function (Request $request) {
        return view('assignments', [
            'title' => 'Tugas Mata Kuliah',
            'active' => 'assignments',
            'courses' => Courses::where('lecturer_id', auth()->user()->id)->get(),
        ]);
    });


    //    route mahasiswa
    Route::get('/course_students', function (Request $request) {
        return view('course_students', [
            'title' => 'Mata Kuliah',
            'active' => 'course_students'
        ]);
    });
    Route::get('/material_students', function (Request $request) {
        return view('material_students', [
            'title' => 'Materi Kuliah',
            'active' => 'material_students'
        ]);
    });
    Route::get('/assignment_students', function (Request $request) {
        return view('assignment_students', [
            'title' => 'Materi Kuliah',
            'active' => 'assignment_students'
        ]);
    });
});
