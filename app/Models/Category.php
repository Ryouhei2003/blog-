<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    // Postモデルとのリレーションを定義
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    // カテゴリーごとに属する投稿を取得するメソッド
    public function getByCategory(int $limit_count = 5)
    {
        return $this->posts()
                    ->orderBy('updated_at', 'DESC')
                    ->paginate($limit_count);
    }
}