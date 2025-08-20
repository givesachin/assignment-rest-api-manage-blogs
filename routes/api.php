<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\BlogController;

Route::apiResource('posts', PostController::class);
Route::apiResource('blogs', BlogController::class);
