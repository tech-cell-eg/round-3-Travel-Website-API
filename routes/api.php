<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Website\FaqController;
use App\Http\Controllers\Website\AuthController;
use App\Http\Controllers\Website\TourController;
use App\Http\Controllers\Website\ArticleController;
use App\Http\Controllers\Website\FeatureController;
use App\Http\Controllers\Website\TourReviewController;
use App\Http\Controllers\Website\DestinationController;
use App\Http\Controllers\Website\ReservationController;
use App\Http\Controllers\Website\TestimonialController;
use App\Http\Controllers\Website\TourCategoryController;



Route::apiResource('articles', ArticleController::class)->only(['index']);
Route::apiResource('testimonials', TestimonialController::class)->only(['index']);
Route::apiResource('tours', TourController::class)->only(['index', 'show']);
Route::apiResource('tour-categories', TourCategoryController::class)->only(['index', 'show']);
Route::apiResource('destinations', DestinationController::class)->only(['index', 'show']);
Route::apiResource('features', FeatureController::class)->only(['index']);
Route::apiResource('faqs', FaqController::class)->only(['index']);


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::apiResource('tours.reviews', TourReviewController::class)->only(['store']);
    Route::apiResource('tours.reservations', ReservationController::class)->only(['store']);
});