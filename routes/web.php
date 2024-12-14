<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\likeController;
use App\Http\Controllers\VisitController;
use App\Http\Controllers\CommentController;

// Welcome ビューへのルート
Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome'); 

// ダッシュボードビュー
Route::get('/dashboard', 
[PostController::class, 'index']
)->middleware(['auth', 'verified'])->name('dashboard');

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
//jsのfetchメソッドで'/post/like'としているため、ルーティングも以下のように'/post/like'とします。
Route::post('/post/like', [LikeController::class, 'likePost'])->name('post.like');
// いいねリセットボタン用ルート
Route::delete('/posts/{post}/likes/reset', [LikeController::class, 'resetLikes'])->name('post.likes.reset');

Route::middleware('auth')->group(function () {
    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
});

//コメント機能のルート
Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');
Route::post('/posts/{post}/comments', [CommentController::class, 'store'])->name('comments.store');


// 認証関連のルート
require __DIR__.'/auth.php';
