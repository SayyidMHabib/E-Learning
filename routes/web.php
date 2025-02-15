<?php

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

Route::middleware('auth:sanctum', 'update.last_used')->get('/dashboard', function (Request $request) {
    return view('index', [
        'title' => 'Dashboard',
        'active' => 'dashboard'
    ]);
});
