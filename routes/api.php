<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\LibraryAccessController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    // Пользователи
    Route::get('/users', [UserController::class, 'index']);
    Route::post('/library/access', [LibraryAccessController::class, 'grantAccess']);

    // Книги
    Route::get('/books', [BookController::class, 'index']);
    Route::post('/books', [BookController::class, 'store']);
    Route::get('/books/{id}', [BookController::class, 'show']);
    Route::put('/books/{id}', [BookController::class, 'update']);
    Route::delete('/books/{id}', [BookController::class, 'destroy']);
    Route::patch('/books/{id}/restore', [BookController::class, 'restore']);


    // Книги других пользователей (если есть доступ)
    Route::get('/users/{id}/books', [BookController::class, 'getUserBooks']);

    // Поиск и сохранение внешних книг
    Route::get('/books/search', [BookController::class, 'searchBooks']);
    Route::post('/books/save', [BookController::class, 'saveExternalBook']);
});
