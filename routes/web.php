<?php

use App\Http\Controllers\AuthDiscord;
use App\Http\Middleware\CheckIfStaff;
use App\Http\Middleware\CheckUserOnline;
use App\Livewire\ArticlesManager;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontController;
use App\Livewire\Navbar;
use App\Livewire\UserInfo;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;
use Illuminate\Support\Facades\Session;

Route::middleware('web')->group(function () {
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::get('/', [FrontController::class, 'index'])->name('home');

    Route::get('/profile', UserInfo::class)->name('user');
    Route::get('/user?{id}', [FrontController::class, 'userProfile'])->name('user.profile');
    Route::post('/user?{id}/comment', [FrontController::class, 'postComment'])->name('user.comment')->middleware('auth');
    Route::post('/user-banner-upload', [FrontController::class, 'bannerUserUpload'])->name('banner.update')->middleware('auth');





    Route::put('/comments/{commentId}', [FrontController::class, 'updateComment'])->name('comment.update');
    Route::delete('/comments/{commentId}', [FrontController::class, 'deleteComment'])->name('comment.delete');

    Route::get('/members', [FrontController::class, 'Members'])->name('members');
    Route::post('/logout', [FrontController::class, 'logout'])->name('logout');

    Route::get('/auth/discord/callback', [AuthDiscord::class, 'handleDiscordCallback'])->name('auth-discord-callback');
    Route::get('/auth/discord', [AuthDiscord::class, 'redirectToDiscord'])->name('auth.discord');
    Route::get('/about-radio', [FrontController::class, 'About'])->name('about');

    Route::get('/api/users', [FrontController::class, 'indexForUsers'])->name('api.users.index');
    Route::get('/api/users/search', [FrontController::class, 'search'])->name('api.users.search');
});


/*! DISABLED FOR NOW
Route::get('/create-announcement', [FrontController::class, 'createArticle'])->name('create-announcement');

Route::post('/create-announcement', [ArticlesManager::class, 'createArticle'])->name('articles.store');

Route::get('/articles/article', [FrontController::class, 'articleShow'])->name('article.show');

Route::get('/articles/article/{id}', [FrontController::class, 'articleDetail'])->name('article.detail'); !*/


Route::middleware([CheckIfStaff::class])->group(function () {
    Route::get('/create-staff', [FrontController::class, 'createStaff'])->name('staff');
});
