<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

// Welcome ビューへのルート
Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome');

// ダッシュボードビュー
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// プロフィール関連ルート
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// 投稿関連ルート
Route::resource('posts', PostController::class);

// トップページ (yurucamp.blade.php)
Route::get('/', function () {
    return view('yurucamp');
})->name('home');

// 投稿一覧 (posts.index)
Route::get('/index', [PostController::class, 'index'])->name('index');

// 認証関連のルート
require __DIR__.'/auth.php';
