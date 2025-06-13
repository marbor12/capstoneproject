<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\DestinationController;
use App\Http\Controllers\Api\ReviewController; 
use App\Http\Controllers\Api\RecommendationController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('register', [RegisterController::class, 'register']);
Route::post('login', [LoginController::class, 'login']);
Route::middleware('auth:sanctum')->post('logout', [LoginController::class, 'logout']);

Route::get('destinations', [DestinationController::class, 'index']);
Route::get('destinations/{slug}', [DestinationController::class, 'show']);

// Review API
Route::get('reviews', [ReviewController::class, 'index']);
Route::get('reviews/{id}', [ReviewController::class, 'show']);
Route::post('reviews', [ReviewController::class, 'store']);
Route::post('reviews/{review}/like', [ReviewController::class, 'like']);

// Recommendation API
Route::get('recommendations', [RecommendationController::class, 'index']);