<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderProductController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return response()->json([
            'success' => true,
            'data' => $request->user(),
        ]);
    });

    Route::post('/logout', [AuthController::class, 'logout']);

    Route::resource('categories', CategoryController::class);
    Route::resource('orders', OrderController::class);
    Route::resource('orderproducts', OrderProductController::class);
    Route::resource('payments', PaymentController::class);
    Route::resource('products', ProductController::class);
    Route::resource('users', UserController::class);
});
