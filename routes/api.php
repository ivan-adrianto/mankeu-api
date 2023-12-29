<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/users', [UserController::class, 'store']);
Route::post('/login', [UserController::class, 'login'], );
Route::get('/users/{id}', [UserController::class, 'show'])->middleware('auth');

Route::post('/transactions', [TransactionController::class, 'store'])->middleware('auth');

Route::post('/categories', [CategoryController::class, 'store'])->middleware('auth');
Route::get('/categories', [CategoryController::class, 'show'])->middleware('auth');
Route::put('/categories/{categoryId}', [CategoryController::class, 'update'])->middleware('auth');
Route::delete('/categories/{categoryId}', [CategoryController::class, 'destroy'])->middleware('auth');