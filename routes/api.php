<?php

use App\Http\Controllers\Api\ProductCategoriesController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\ProductGalleriesController;
use App\Http\Controllers\Api\TransactionController;
use App\Http\Controllers\Api\UserController;
use App\Models\ProductGalleries;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/user/register', [UserController::class, 'register']);
Route::post('/user/login', [UserController::class, 'login']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/user/fetch', [UserController::class, 'fetch']);
    Route::post('/user/update', [UserController::class, 'updateProfile']);
    Route::post('/user/logout', [UserController::class, 'logout']);

    Route::get('/transactions', [TransactionController::class, 'all']);
    Route::get('/checkout', [TransactionController::class, 'checkout']);
});

Route::get('/product', [ProductController::class, 'all']);
Route::get('/category', [ProductCategoriesController::class, 'all']);
Route::post('/galeri/simpan', [ProductGalleriesController::class, 'simpan']);
