<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TodoListController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful;

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/logout',[AuthController::class,'logout']);
    Route::get('/users',[AuthController::class,'index']);
    Route::get('/deleteUsers/{id}',[AuthController::class,'delete']);

    Route::post('/product',[ProductController::class,'product']);
    Route::post('/products',[ProductController::class,'index']);
    Route::get('/delete-product/{id}',[ProductController::class,'delete']);
    Route::post('/product/{id}',[ProductController::class,'edit']);
});

Route::post('/login',[AuthController::class,'login']);
Route::post('/register',[AuthController::class,'register']);

