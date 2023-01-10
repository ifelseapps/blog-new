<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('main');
})->name('main');

Route::get('/admin/{path?}', function () {
    if (!Auth::check()) {
        return redirect('/auth/');
    }
    return view('admin');
})->name('admin');

Route::get('/auth', [LoginController::class, 'loginForm'])->name('loginForm');

Route::post('/auth', [LoginController::class, 'login'])->name('login');

Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
