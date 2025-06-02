<?php

use App\Http\Middleware\RoleMiddleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;

// =================== AUTH ===================
Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);

// =================== ROUTE PROTECTED ===================
Route::middleware(['auth:sanctum'])->group(function () {

    // ----------- ADMIN & PETUGAS BISA AKSES SEMUA BOOKS CRUD KECUALI DOWNLOAD -----------
    Route::middleware([RoleMiddleware::class . ':admin-petugas-siswa'])->group(function () {
        Route::get('/books', [BookController::class, 'index']);
        Route::get('/books/{id}', [BookController::class, 'show']);

        Route::middleware([RoleMiddleware::class . ':admin-petugas'])->group(function () {
            Route::post('/books', [BookController::class, 'store']);
            Route::put('/books/{id}', [BookController::class, 'update']);
            Route::delete('/books/{id}', [BookController::class, 'destroy']);
        });
    });

    // ----------- ADMIN ONLY -----------
    Route::middleware([RoleMiddleware::class . ':admin'])->group(function () {
        // dashboard
        Route::get('/dashboard', [DashboardController::class, 'index']);

        // manajemen user
        Route::get('/users', [UserController::class, 'index']);
        Route::post('/users', [UserController::class, 'store']);
        Route::put('/users/{id}', [UserController::class, 'update']);
        Route::delete('/users/{id}', [UserController::class, 'destroy']);
    });
});
