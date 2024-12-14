<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use App\Models\Visit;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;

class PostController extends Controller
{
    // 投稿一覧を表示
    public function index(Request $request)
    {
        // 検索キーワードを取得
        $keyword = $request->input('keyword');

        // ベースクエリ（最新順）
        $query = Post::orderBy('created_at', 'desc');

        // キーワード検索があれば、タイトルで絞り込み
        if (!empty($keyword)) {
            $query->where('title', 'LIKE', "%{$keyword}%");
        }

        // 必要なリレーションを読み込んでデータを取得
        $posts = $query->with('category', 'user')->paginate(10);

        // 訪問カウンターの処理（セッションを使用）
        if (!$request->session()->has('visited_index')) {
            $visit = Visit::firstOrCreate([], ['count' => 0]);
            $visit->increment('count'); // カウントを1増加

            // セッションにフラグを保存
            $request->session()->put('visited_index', true);
        }

        // 現在の訪問カウントを取得
        $visitCount = Visit::first()->count;

        // ビューにデータを渡して表示
        return view('posts.index', compact('posts', 'keyword', 'visitCount'));
    }

    // 特定の投稿を表示
    public function show(Post $post)
    {
        $post->load('comments.user'); // コメントとその投稿者を取得
        return view('posts.show', compact('post'));
    }

    // 新規投稿フォームを表示
    public function create()
    {
        $categories = Category::all();
        return view('posts.create', compact('categories'));
    }

    // 投稿を保存
    public function store(PostRequest $request)
    {
        $user = $request->user();
        if (!$user) {
            return redirect()->route('login')->with('error', 'ログインが必要です。');
        }

        $input = $request->input('post');
        $input['user_id'] = $user->id;

        if (empty($input['category_id'])) {
            $input['category_id'] = 1; // デフォルトカテゴリー
        }

        Post::create($input);

        return redirect()->route('posts.index')->with('success', '投稿を作成しました！');
    }

    // 投稿の編集フォームを表示
    public function edit(Post $post)
    {
        $categories = Category::all();
        return view('posts.edit', compact('post', 'categories'));
    }

    // 投稿を更新
    public function update(PostRequest $request, Post $post)
    {
        $user = $request->user();
        if (!$user) {
            return redirect()->route('login')->with(['error' => 'ログインが必要です。']);
        }

        $input = $request->input('post');
        $input['user_id'] = $user->id;

        if (empty($input['category_id'])) {
            $input['category_id'] = 1; // デフォルトカテゴリー
        }

        $post->update($input);

        return redirect()->route('posts.index')->with('success', '投稿を更新しました！');
    }

    // 投稿を削除
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('posts.index')->with('success', '投稿を削除しました！');
    }
}
