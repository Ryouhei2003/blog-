<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\PostLike;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    // いいねを追加する処理
    public function likePost(Request $request)
    {
        $postId = $request->input('post_id');

        // 新しいいいねを追加
        PostLike::create([
            'post_id' => $postId,
            'user_id' => Auth::id(),
        ]);

        // いいねの総数を取得
        $likesCount = Post::find($postId)->likes()->count();

        return response()->json(['likesCount' => $likesCount]);
    }

    // いいねをリセットする処理
    public function resetLikes(Post $post)
    {
        // 該当投稿のいいねをすべて削除
        $post->likes()->delete();

        return response()->json([
            'message' => 'いいねをリセットしました。',
            'likesCount' => 0,
        ]);
    }
}
