<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FriendController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', DashboardController::class)->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::prefix('friends')->as('friends.')->group(function () {
        Route::get('/', [FriendController::class, 'index'])->name('index');
        Route::get('/potential', [FriendController::class, 'potentialFriends'])->name('potentialFriends');
        Route::get('/request', [FriendController::class, 'requestFriends'])->name('requestFriends');
        Route::post('/request/{friend}', [FriendController::class, 'request'])->name('request');
        Route::post('/accept/{friend}', [FriendController::class, 'accept'])->name('accept');
    });
});

require __DIR__.'/auth.php';
