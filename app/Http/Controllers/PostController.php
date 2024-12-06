<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;

class PostController extends Controller
{

    public function index()
    {
        $posts = Post::with('category')->paginate(10); // 投稿をカテゴリと共に取得
        return view('posts.index', compact('posts'));
    }

    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    public function create()
    {
        $categories = Category::all();
        if ($categories->isEmpty()) {
            return redirect()->route('posts.index')->with('warning', 'カテゴリを追加してください。');
        }
        return view('posts.create', compact('categories'));
    }

    public function store(PostRequest $request)
    {
        // ユーザーが認証されているか確認
        if (!$request->user()) {
            return redirect()->route('login')->with('error', 'ログインが必要です。');
        }

        // フォームデータを取得し、現在のユーザーIDを設定
        $input = $request->input('post');
        $input['user_id'] = $request->user()->id;

        // データを保存
        Post::create($input);

        return redirect()->route('posts.index')->with('success', '投稿を作成しました！');
    }

    public function edit(Post $post)
    {
        $categories = Category::all();
        return view('posts.edit', compact('post', 'categories'));
    }

    public function update(PostRequest $request, Post $post)
    {
        if (!$request->user()) {
            return redirect()->route('login')->with(['error' => 'ログインが必要です。']);
        }

        $input = $request->input('post');
        $input['user_id'] = $request->user()->id; // ユーザーIDを再設定
        $post->update($input);

        return redirect()->route('posts.index')->with('success', '投稿を更新しました！');
    }

    public function destroy(Post $post)
    {
        $post->delete(); // データを削除
        return redirect()->route('posts.index')->with('success', '投稿を削除しました！');
    }
}
