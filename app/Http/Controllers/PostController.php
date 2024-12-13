<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');

        $query = Post::query();

        if (!empty($keyword)) {
            $query->where('title', 'LIKE', "%{$keyword}%");
        }

        $posts = $query->with('category', 'user')->paginate(10);

        return view('posts.index', compact('posts', 'keyword'));
    }

    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    public function store(PostRequest $request)
    {
        // 現在のユーザーを取得
        $user = $request->user();
        if (!$user) {
            return redirect()->route('login')->with('error', 'ログインが必要です。');
        }

        // フォームデータを取得
        $input = $request->input('post');
        $input['user_id'] = $user->id;

        // カテゴリがない場合にデフォルト値を設定
        if (empty($input['category_id'])) {
            $input['category_id'] = 1; // デフォルトのカテゴリID
        }

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
        $user = $request->user();
        if (!$user) {
            return redirect()->route('login')->with(['error' => 'ログインが必要です。']);
        }

        $input = $request->input('post');
        $input['user_id'] = $user->id; // ユーザーIDを再設定

        // カテゴリがない場合にデフォルト値を設定
        if (empty($input['category_id'])) {
            $input['category_id'] = 1; // デフォルトのカテゴリID
        }

        $post->update($input);

        return redirect()->route('posts.index')->with('success', '投稿を更新しました！');
    }

    public function create()
{
    $categories = Category::all(); // カテゴリ一覧を取得
    return view('posts.create', compact('categories')); // ビューに渡す
}


    public function destroy(Post $post)
    {
        $post->delete(); // データを削除
        return redirect()->route('posts.index')->with('success', '投稿を削除しました！');
    }
}