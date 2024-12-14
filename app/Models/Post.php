<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    // $fillable プロパティ
    protected $fillable = [
        'title',
        'body',
        'category_id',
        'user_id',
    ];

    // コメントとのリレーションを定義
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    // 投稿を更新日時順で取得（指定した件数まで）
    public function getByLimit(int $limit_count = 10)
    {
        return $this->orderBy('updated_at', 'DESC')->limit($limit_count)->get();
    }

    // ページネーションを利用して投稿を取得
    public function getPaginateByLimit(int $limit_count = 5)
    {
        return $this::with('category')->orderBy('updated_at', 'DESC')->paginate($limit_count);
    }

    // Categoryに対するリレーション
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Userに対するリレーション
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // post_likesテーブルへのリレーション
    public function likes()
    {
        return $this->hasMany(PostLike::class);
    }

    // 自身がいいねしているかどうか判定するメソッド
    public function isLikedByAuthUser(): bool
    {
        // 認証済みユーザーのIDを取得
        $authUserId = auth()->id();

        // いいねしたユーザーのIDを格納する配列
        $likersArr = [];

        // いいねをした全てのユーザーのIDを配列に格納
        foreach ($this->likes as $postLike) {
            array_push($likersArr, $postLike->user_id);
        }

        // 認証済みユーザーのIDが配列内に存在するかチェック
        return in_array($authUserId, $likersArr);
    }
}
