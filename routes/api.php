<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Casts\Attribut;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LibraryAccessController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BookController;


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::middleware('auth.api:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', fn (Request $request) => $request->user());

    Route::get('/users', [UserController::class, 'index']);
    Route::post('/grant-access/{user}', [UserController::class, 'grantAccess']);

    Route::apiResource('books', BookController::class);
    Route::post('/books/{book}/restore', [BookController::class, 'restore']);
    Route::post('/books/{book}/restore', [BookController::class, 'restore'])->middleware('auth:sanctum');
    Route::get('/books/trashed', [BookController::class, 'trashed']);

});




