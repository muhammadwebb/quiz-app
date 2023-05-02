<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CollectionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/user/verify', [UserController::class, 'send']);
Route::post('/signUp', [UserController::class, 'register']);
Route::get('/users/getme', [UserController::class, 'show'])->middleware(['auth:sanctum','abilities:admin']);
Route::post('/signIn', [UserController::class, 'login']);

Route::prefix('/categories')->group(
    function (){
        Route::get('/', [CategoryController::class, 'index']);
        Route::post('/', [CategoryController::class, 'store']);
        Route::get('/{id}', [CategoryController::class, 'show']);
        Route::patch('/update/{id}', [CategoryController::class, 'update']);
        Route::delete('/delete/{id}', [CategoryController::class, 'destroy']);
    }
);

Route::prefix('/collections')
    ->group(function (){
        Route::post('/', [CollectionController::class, 'store']);
        Route::get('/', [CollectionController::class, 'index']);
        Route::get('/{id}', [CollectionController::class, 'show']);
        Route::patch('/update/{id}', [CollectionController::class, 'update']);
        Route::delete('/delete/{id}', [CollectionController::class, 'destroy']);
    });


