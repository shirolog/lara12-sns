<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;

Route::get('/', function () {
    return redirect('/posts');
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

//お問い合わせフォーム
Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
Route::post('/contact/confirm', [ContactController::class, 'confirm'])->name('contact.confirm');
Route::post('/contact/send', [ContactController::class, 'send'])->name('contact.send');
Route::get('/contact/complete', [ContactController::class, 'complete'])->name('contact.complete');

require __DIR__.'/auth.php';
