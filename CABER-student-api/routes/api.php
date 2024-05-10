<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//Route::get('/students/{id}', [UserController::class, 'find']);
Route::get('/users', [UserController::class, 'index']);
Route::post('/users', [UserController::class, 'new']);
Route::patch('/students/{id}', [UserController::class, 'update']);
Route::delete('/students/{id}', [UserController::class, 'remove']);