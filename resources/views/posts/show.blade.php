<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Posts</title>
    </head>
    <body>
        <h1>{{ $post->title }}</h1> <!-- 投稿タイトルを表示 -->
    <p>{{ $post->body }}</p> <!-- 投稿本文を表示 -->
    <a href="{{ url('/posts') }}">ブログ投稿一覧へ戻る</a> <!-- 投稿一覧ページへのリンク -->
    <div class="edit">
        <a href="/posts/{{ $post->id }}/edit">edit</a> <!-- 編集ページへのリンク -->
    </div>
</body>
</html>