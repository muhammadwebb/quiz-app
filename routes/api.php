<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CollectionController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::post('/signUp', [UserController::class, 'register']);
Route::get('/user/verify/{code}', [UserController::class, 'send']);

Route::post('/signIn', [UserController::class, 'login']);
Route::get('/users/getme', [UserController::class, 'show'])->middleware(['auth:sanctum','abilities:admin']);

Route::middleware(['auth:sanctum', 'abilities:admin'])->prefix('/categories')->group(
    function (){
        Route::get('/', [CategoryController::class, 'index']);
        Route::post('/', [CategoryController::class, 'store']);
        Route::get('/{id}', [CategoryController::class, 'show']);
        Route::patch('/update/{id}', [CategoryController::class, 'update']);
        Route::delete('/delete/{id}', [CategoryController::class, 'destroy']);
    }
);

Route::middleware(['auth:sanctum', 'abilities:admin'])->prefix('/collections')->group(function (){
        Route::post('/', [CollectionController::class, 'store']);
        Route::get('/', [CollectionController::class, 'index']);
        Route::get('/{id}', [CollectionController::class, 'show']);
        Route::patch('/update/{id}', [CollectionController::class, 'update']);
        Route::delete('/delete/{id}', [CollectionController::class, 'destroy']);
    });

Route::middleware(['auth:sanctum', 'abilities:admin'])->prefix('/question')->group(function (){
        Route::post('/', [QuestionController::class, 'store']);
        Route::get('/', [QuestionController::class, 'index']);
        Route::get('/{id}', [QuestionController::class, 'show']);
    });
