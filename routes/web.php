<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;


Route::get('/', function () {
    return view('welcome');
});

// Authentication routes
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

// Registration routes
Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);

Auth::routes(['verify'=>true]);

Route::get('/dashboard.users', [App\Http\Controllers\HomeController::class, 'index'])->middleware('verified')->name('home');

// Route for admin panel, requiring authentication
Route::middleware('auth')->group(function () {
    Route::get('admin', function () {
        return redirect()->route('login');
    })->name('admin');
});

require base_path('routes/dashboard.php');
