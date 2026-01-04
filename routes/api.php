<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\Auth\AuthController;

//Route::get('notes',[NotesController::class,'index']);
Route::get('/products',[ProductsController::class,'index']);
Route::post('products',[ProductsController::class,'store']);
Route::put('products/{id}',[ProductsController::class,'update']);
Route::get('products/{id}',[ProductsController::class,'show']);
Route::delete('products/{id}',[ProductsController::class,'destroy']);

Route::post('auth/register',[AuthController::class,'store']);
Route::post('auth/login',[AuthController::class,'login']);
Route::post('auth/logout',[AuthController::class,'logout'])->middleware('auth:sanctum');
Route::get('auth/me',[AuthController::class,'me'])->middleware('auth:sanctum');
