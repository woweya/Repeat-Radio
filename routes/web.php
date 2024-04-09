<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontController;

Route::get('/', [FrontController::class, 'index'])->name('home');

Route::get('/user/{id}', [FrontController::class, 'User'])->name('user');
