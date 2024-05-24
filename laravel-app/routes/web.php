<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\Auth\LoginController;


Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

// Apply auth middleware to Task resource routes
Route::middleware(['auth'])->group(function () {
    Route::resource('tasks', TaskController::class);
    Route::get('/', [TaskController::class, 'index'])->name('home');
});
// Route::resource('duties', DutyController::class);
