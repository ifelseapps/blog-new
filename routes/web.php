<?php

use App\Http\Controllers\Web\LoginController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('main');
})->name('main');

Route::get('/admin/{path?}/{path2?}/', function () {
    if (!Auth::check()) {
        return redirect('/auth/');
    }
    return view('admin');
})->name('admin');

Route::get('/auth', [LoginController::class, 'loginForm'])->name('loginForm');

Route::post('/auth', [LoginController::class, 'login'])->name('login');

Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
