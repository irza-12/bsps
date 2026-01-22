<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BspsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Guest routes
Route::middleware('guest')->group(function () {
    Route::get('/', function () {
        return redirect()->route('login');
    });
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

// Authenticated routes
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // BSPS routes
    Route::get('/data-bsps', [BspsController::class, 'index'])->name('bsps.index');
    Route::get('/data-bsps/create', [BspsController::class, 'create'])->name('bsps.create');
    Route::post('/data-bsps', [BspsController::class, 'store'])->name('bsps.store');
    Route::get('/data-bsps/{bsp}/edit', [BspsController::class, 'edit'])->name('bsps.edit');
    Route::put('/data-bsps/{bsp}', [BspsController::class, 'update'])->name('bsps.update');
    Route::delete('/data-bsps/{bsp}', [BspsController::class, 'destroy'])->name('bsps.destroy');

    // Export routes
    Route::get('/export/excel', [ExportController::class, 'exportExcel'])->name('export.excel');
    Route::get('/export/pdf', [ExportController::class, 'exportPdf'])->name('export.pdf');

    // User management (admin only)
    Route::middleware(\App\Http\Middleware\AdminMiddleware::class)->group(function () {
        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
        Route::post('/users', [UserController::class, 'store'])->name('users.store');
        Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
        Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    });
});
