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

    // ----------- USER BIASA -----------
    Route::middleware([RoleMiddleware::class . ':user'])->group(function () {
        Route::get('/books', [BookController::class, 'index']);
        Route::get('/books/{id}', [BookController::class, 'show']);
        Route::get('/books/{id}/download', [BookController::class, 'download']);
    });

    // ----------- PETUGAS -----------
    Route::middleware([RoleMiddleware::class . ':petugas'])->group(function () {
        Route::get('/books', [BookController::class, 'index']);
        Route::post('/books', [BookController::class, 'store']);
        Route::get('/books/{id}', [BookController::class, 'show']);
        Route::put('/books/{id}', [BookController::class, 'update']);
        Route::delete('/books/{id}', [BookController::class, 'destroy']);
    });

    // ----------- ADMIN -----------
    Route::middleware([RoleMiddleware::class . ':admin'])->group(function () {
        // dashboard
        Route::get('/dashboard', [DashboardController::class, 'index']);

        // manajemen buku
        Route::get('/books', [BookController::class, 'index']);
        Route::post('/books', [BookController::class, 'store']);
        Route::get('/books/{id}', [BookController::class, 'show']);
        Route::put('/books/{id}', [BookController::class, 'update']);
        Route::delete('/books/{id}', [BookController::class, 'destroy']);

        // manajemen user
        Route::get('/users', [UserController::class, 'index']);
        Route::post('/users', [UserController::class, 'store']);
        Route::put('/users/{id}', [UserController::class, 'update']);
        Route::delete('/users/{id}', [UserController::class, 'destroy']);
    });
});
