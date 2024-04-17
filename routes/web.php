<?php

use App\Http\Controllers\AuthDiscord;
use App\Http\Middleware\CheckUserOnline;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontController;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;
use Illuminate\Support\Facades\Session;

Route::get('/', [FrontController::class, 'index'])->name('home');

Route::get('/user/{id}', [FrontController::class, 'User'])->name('user');

Route::get('/members', [FrontController::class, 'Members'])->name('members');

/* Route::get('/about-radio', [FrontController::class, 'About'])->name('about')->middleware(CheckUserOnline::class); */

Route::middleware([CheckUserOnline::class])->group(function () {
    Route::get('/about-radio', [FrontController::class, 'About'])->name('about');
});
Route::post('/update-image', [FrontController::class, 'UpdateImage'])->name('update.image');

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

Route::get('/auth/discord/callback', [AuthDiscord::class, 'handleDiscordCallback'])->name('auth-discord-callback');

Route::get('/auth/discord', [AuthDiscord::class, 'redirectToDiscord'])->name('auth.discord');
