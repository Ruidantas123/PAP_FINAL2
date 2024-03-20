<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\UserAuthController;
use App\Http\Controllers\api\UserController;
use App\Http\Controllers\api\ComponenteController;
use App\Http\Controllers\api\ProductController;
use Laravel\Sanctum\Http\Controllers\CsrfCookieController;


// Use 'auth:sanctum' middleware instead of 'api'
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/sanctum/csrf-cookie', [CsrfCookieController::class, 'show']);

Route::middleware(['auth:sanctum'])->group(function () {
    // Your existing routes...
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});  // <-- Closing parenthesis for the group

Route::get('componente', [componenteController::class, 'index']);
Route::post('componente', [componenteController::class, 'store']);
Route::get('componente/{id}', [componenteController::class, 'show']);
Route::put('componente/{id}', [componenteController::class, 'update']);
Route::delete('componente/{id}', [componenteController::class, 'destroy']);

Route::get('users', [userController::class, 'index']);
Route::post('users', [userController::class, 'store']);
Route::get('users/{id}', [userController::class, 'show']);
Route::put('users/{id}', [userController::class, 'update']);
Route::delete('users/{id}', [userController::class, 'destroy']);

Route::get('product', [ProductController::class, 'index']);
Route::post('product', [ProductController::class, 'store']);
Route::get('product/{id}', [ProductController::class, 'show']);
Route::put('product/{id}', [ProductController::class, 'update']);
Route::delete('product/{id}', [ProductController::class, 'destroy']);

Route::group(['middleware' => 'api'], function ($router) {
    Route::get('user', [UserAuthController::class, 'user']);
    Route::post('refresh', [UserAuthController::class, 'refresh']);
    Route::post('logout', [UserAuthController::class, 'logout']);
    Route::post('register', [UserAuthController::class, 'register']);
    Route::match(['post', 'get'], 'login', [UserAuthController::class, 'login'])->name('login');
    
});

