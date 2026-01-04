<?php
use App\Http\Controllers\ChirpController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\Register;
use App\Http\Controllers\Auth\Login;
use App\Http\Controllers\Auth\Logout;
use Illuminate\Support\Facades\Route;

// Landing page
Route::view('/welcome', 'welcome')->name('welcome');

// Home feed
Route::get('/', [ChirpController::class, 'index'])->name('home');

// Authentication routes
Route::middleware('guest')->group(function () {
    Route::view('/register', 'auth.register')->name('register');
    Route::post('/register', Register::class);
    Route::view('/login', 'auth.login')->name('login');
    Route::post('/login', Login::class);
});

Route::post('/logout', Logout::class)
    ->middleware('auth')
    ->name('logout');

// Chirp routes
Route::middleware('auth')->group(function () {
    Route::post('/chirps', [ChirpController::class, 'store']);
    Route::get('/chirps/{chirp}', [ChirpController::class, 'show'])->name('chirps.show');
    Route::get('/chirps/{chirp}/edit', [ChirpController::class, 'edit'])->name('chirps.edit');
    Route::put('/chirps/{chirp}', [ChirpController::class, 'update']);
    Route::delete('/chirps/{chirp}', [ChirpController::class, 'destroy']);
    Route::post('/chirps/{chirp}/like', [ChirpController::class, 'like'])->name('chirps.like');
});

// Comment routes
Route::middleware('auth')->group(function () {
    Route::post('/chirps/{chirp}/comments', [CommentController::class, 'store']);
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy']);
});

// Profile routes
Route::middleware('auth')->group(function () {
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

Route::get('/profile/{user}', [ProfileController::class, 'show'])->name('profile.show');