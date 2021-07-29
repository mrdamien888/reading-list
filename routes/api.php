<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BookController;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('/books')->group(function(){
    Route::get('/', [BookController::class, 'index'])->name('api.books');
    Route::get('/order', [BookController::class, 'order']);
    Route::get('/sort', [BookController::class, 'sort']);
});

Route::prefix('/book')->group(function(){
    Route::post('/add', [BookController::class, 'store']);
    Route::get('/details/{id}', [BookController::class, 'show']);
    Route::delete('/remove/{id}', [BookController::class, 'destroy']);
});