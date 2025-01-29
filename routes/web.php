<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnimeController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WatchlistController;

Route::get('/', [AnimeController::class, 'index'])->name('home');
Route::get('/search', [AnimeController::class, 'search'])->name('anime.search');
Route::get('/anime/{id}', [AnimeController::class, 'show'])->name('anime.show');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    Route::post('/anime/{id}/reviews', [ReviewController::class, 'store'])->name('reviews.store');
    Route::delete('/reviews/{review}', [ReviewController::class, 'destroy'])->name('reviews.destroy');

    // Watchlist Routes
    Route::get('/watchlist', [WatchlistController::class, 'index'])->name('watchlist.index');
    Route::post('/watchlist/{anime}', [WatchlistController::class, 'store'])->name('watchlist.store');
    Route::patch('/watchlist/{anime}', [WatchlistController::class, 'update'])->name('watchlist.update');
    Route::delete('/watchlist/{anime}', [WatchlistController::class, 'destroy'])->name('watchlist.destroy');
});

require __DIR__.'/auth.php';
