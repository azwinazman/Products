<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductsController;

//Route::get('notes',[NotesController::class,'index']);
Route::get('/products',[ProductsController::class,'index']);
Route::post('products',[ProductsController::class,'store']);
Route::put('products/{id}',[ProductsController::class,'update']);
Route::get('products/{id}',[ProductsController::class,'show']);
Route::delete('products/{id}',[ProductsController::class,'destroy']);
