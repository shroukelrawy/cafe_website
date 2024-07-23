<?php
use App\Http\Middleware\CheckActiveUser;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BeverageController;
use App\Http\Controllers\ContactController;



   

Route::middleware([CheckActiveUser::class],'auth', 'verified')->prefix('dashboard')->group(function () {
        // User routes
        Route::get('/users', [UserController::class, 'index'])->name('dashboard.users');
        Route::get('users/{id}/edit', [UserController::class, 'edit'])->name('dashboard.edituser');
        Route::put('users/{id}', [UserController::class, 'update'])->name('dashboard.updateuser');
        Route::get('adduser', [UserController::class, 'create'])->name('dashboard.adduser');
        Route::post('adduser', [UserController::class, 'store'])->name('dashboard.storeuser');

        // Category routes
        Route::get('categories', [CategoryController::class, 'index'])->name('dashboard.categories');
        Route::get('categories/create', [CategoryController::class, 'create'])->name('dashboard.addcategory');
        Route::post('categories', [CategoryController::class, 'store'])->name('dashboard.storecategory');
        Route::get('categories/{category}/edit', [CategoryController::class, 'edit'])->name('dashboard.editcategory');
        Route::put('categories/{category}', [CategoryController::class, 'update'])->name('dashboard.updatecategory');
        Route::delete('categories/{category}', [CategoryController::class, 'destroy'])->name('dashboard.deletecategory');
        
        // Beverage routes
        Route::get('beverages', [BeverageController::class, 'index'])->name('dashboard.beverages');
        Route::get('beverages/create', [BeverageController::class, 'create'])->name('dashboard.addbeverage');
        Route::post('beverages', [BeverageController::class, 'store'])->name('dashboard.storebeverage');
        Route::get('beverages/{beverage}/edit', [BeverageController::class, 'edit'])->name('dashboard.editbeverage');
        Route::put('beverages/{beverage}', [BeverageController::class, 'update'])->name('dashboard.updatebeverage');
        Route::delete('beverages/{beverage}', [BeverageController::class, 'destroy'])->name('dashboard.deletebeverage');

        Route::get('/messages', [ContactController::class, 'index'])->name('dashboard.messages');
    
        // Route to show a specific message
        Route::get('/messages/{id}', [ContactController::class, 'show'])->name('messages.show');
        Route::delete('/messages/{id}', [ContactController::class, 'destroy'])->name('messages.destroy');
        Route::get('/dashboard/messages/{id}', [ContactController::class, 'show'])->name('dashboard.showmessage');


    });