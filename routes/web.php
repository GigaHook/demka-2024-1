<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn() => to_route('auth.loginpage'));

Route::middleware('guest')->group(function() {
    Route::inertia('/login', 'Login')->name('auth.loginpage');
    Route::inertia('/register', 'Register')->name('auth.registerpage');
    Route::post('/login', [UserController::class, 'login'])->name('auth.login');
    Route::post('/register', [UserController::class, 'register'])->name('auth.register');
});

Route::middleware('auth')->group(function() {
    Route::get('/logout', [UserController::class, 'logout'])->name('auth.logout');
    Route::controller(OrderController::class)->prefix('orders')->group(function() {
        Route::get('/', 'index')->name('orders.index');
        Route::get('/create', 'create')->name('orders.create');
        Route::post('/', 'store')->name('orders.store');
    });
});

Route::patch('orders/{order}', [OrderController::class, 'update'])->name('orders.update')->middleware('admin');