<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('api')
    ->prefix('/post')->group(function () {
        Route::post('/', [App\Http\Controllers\BlogPostController::class, 'create']);
    });
