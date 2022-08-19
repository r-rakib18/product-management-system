<?php

use App\Http\Middleware\Authenticate;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::middleware( [ Authenticate::class ] )->group( function () {
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
    Route::resource('category', CategoryController::class);
    Route::resource('product', ProductController::class);
});
