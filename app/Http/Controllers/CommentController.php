<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, Post $post)
    {
        // ユーザーがログインしているか確認
        if (!$request->user()) {
            return redirect()->route('login')->with('error', 'コメントを投稿するにはログインが必要です。');
        }

        // 入力値のバリデーション
        $request->validate([
            'body' => 'required|string|max:255',
        ]);

        // コメントを作成
        Comment::create([
            'post_id' => $post->id,
            'user_id' => $request->user()->id,
            'body' => $request->body,
        ]);

        // 投稿詳細ページにリダイレクト
        return redirect()->route('posts.show', $post)->with('success', 'コメントを追加しました！');
    }
}
