<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('login',[AuthController::class, 'login']);
Route::post('register',[AuthController::class, 'register']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('users', UserController::class)->middleware('auth:sanctum');

Route::middleware('auth:sanctum')
    ->get('messages/user/{user}',[MessageController::class, 'messageUser']);

Route::middleware('auth:sanctum')
    ->post('messages/user/{user}',[MessageController::class, 'store']);
//Route::post('')
