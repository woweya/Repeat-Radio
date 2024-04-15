<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontController;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;

Route::get('/', [FrontController::class, 'index'])->name('home');

Route::get('/user/{id}', [FrontController::class, 'User'])->name('user');

Route::get('/members', [FrontController::class, 'Members'])->name('members');

Route::get('/about-radio', [FrontController::class, 'About'])->name('about');

Route::post('/update-image', [FrontController::class, 'UpdateImage'])->name('update.image');

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
