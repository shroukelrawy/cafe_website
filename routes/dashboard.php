<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;



    Route::prefix('dashboard')
    ->middleware(['auth', 'verified'])
    ->group(function () {
        Route::get('/users', [UserController::class, 'index'])->name('dashboard.users');
    });

Route::prefix('admin')
    ->middleware(['auth', 'verified'])
    ->group(function () {
        Route::get('users/{id}/edit', [UserController::class, 'edit'])->name('dashboard.edituser');
        Route::put('users/{id}', [UserController::class, 'update'])->name('dashboard.updateuser');
   
    });