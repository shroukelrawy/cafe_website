<?php
use App\Http\Middleware\CheckActive;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

// Authentication routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Registration routes
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);


Auth::routes(['verify'=>true]);


// Route for admin panel, requiring authentication
Route::middleware('auth', 'verified')->group(function () {
    Route::get('/admin', function () {
        return redirect()->route('login');
    })->name('admin');
});

// Route::get('/inactive', function () {
//     return view('auth.login')->with('error', 'Your Account Not Active.');
// })->name('inactive');

require base_path('routes/dashboard.php');

