<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

// '/' ルートにアクセスがあった場合、PostControllerのindexメソッドを実行
Route::get('/', [PostController::class, 'index']);

// '/posts/{post}' ルートにアクセスがあった場合、PostControllerのshowメソッドを実行
Route::get('/posts/{post}', [PostController::class, 'show']);