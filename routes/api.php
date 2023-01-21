<?php

use Illuminate\Support\Facades\Route;

Route::middleware('api')
    ->prefix('/post')->group(function () {
        Route::post('/', [\App\Blog\Infrastructure\Controllers\Api\BlogPostController::class, 'create']);
    });
