<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
});

Route::resource('posts', PostController::class)->only('index', 'show');

Route::resource('posts', PostController::class)->except('create', 'store', 'index', 'show')->middleware('auth');

Route::post('posts/{post}/comments', [CommentController::class, 'store'])->name('comments.store');

Route::post('posts/{post}/likes', [LikeController::class, 'toggleLike'])->name('posts.like')->middleware('auth');

require __DIR__.'/auth.php';
