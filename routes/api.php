<?php

use App\Http\Controllers\Api\ProductCategoriesController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\ProductGalleriesController;
use App\Models\ProductGalleries;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/product', [ProductController::class, 'all']);
Route::get('/category', [ProductCategoriesController::class, 'all']);
Route::post('/galeri/simpan', [ProductGalleriesController::class, 'simpan']);
