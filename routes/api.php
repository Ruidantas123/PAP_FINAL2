<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


use App\Http\Controllers\api\userController;
use App\Http\Controllers\api\pecasController;
use App\Http\Controllers\api\ProductController;
use App\Http\Controllers\api\componenteController;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('componente', [componenteController::class, 'index']);
Route::post('componente', [componenteController::class, 'store']);
Route::get('componente/{id}', [componenteController::class, 'show']);
Route::put('componente/{id}', [componenteController::class, 'update']);
Route::delete('componente/{id}', [componenteController::class, 'destroy']);
//////////////////////////////////////////////////////////////////////////
Route::get('users', [userController::class, 'index']);
Route::post('users', [userController::class, 'store']);
Route::get('users/{id}', [userController::class, 'show']);
Route::put('users/{id}', [userController::class, 'update']);
Route::delete('users/{id}', [userController::class, 'destroy']);
//////////////////////////////////////////////////////////////////////////
Route::get('product', [ProductController::class, 'index']);
Route::post('product', [ProductController::class, 'store']);
Route::get('product/{id}', [ProductController::class, 'show']);
Route::put('product/{id}', [ProductController::class, 'update']);
Route::delete('product/{id}', [ProductController::class, 'destroy']);
//////////////////////////////////////////////////////////////////////////
