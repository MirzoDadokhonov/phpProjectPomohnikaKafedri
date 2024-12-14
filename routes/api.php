<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\v1\ApiCategoryController;
use App\Http\Controllers\v1\ApiPublicationController;
use App\Http\Controllers\v1\ApiSphereController;
use App\Http\Controllers\v1\ApiAuthorController;
use App\Http\Controllers\v1\ApiProfileController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('v1/categories', ApiCategoryController::class);
Route::apiResource('v1/spheres', ApiSphereController::class);
Route::apiResource('v1/authors', ApiAuthorController::class);
Route::apiResource('v1/publications', ApiPublicationController::class);
Route::apiResource('v1/profiles', ApiProfileController::class);
