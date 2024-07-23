<?php
use App\Http\Middleware\CheckActive;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\SpecialItemsController;
use App\Http\Controllers\ContactController;


// Route::get('/index', function () {
//     return view('index');
// })->name('index');
Route::get('/contact', [ContactController::class, 'showForm'])->name('contact.form');
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');
Route::get('/specialitems', [SpecialItemsController::class, 'specialitems'])->name('specialitems');
Route::get('/index', [HomeController::class, 'drinkmenu'])->name('index');
Route::get('/about', [AboutController::class, 'about'])->name('about');


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

