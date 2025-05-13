<?php

use App\Http\Controllers\Api\V1\CategoryController;
use App\Http\Controllers\Api\V1\ProductController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::get('/products/export', [ProductController::class, 'export']);
    Route::apiResource('products', ProductController::class);
    Route::apiResource('categories', CategoryController::class);
});
