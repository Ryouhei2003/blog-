<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ブログ投稿編集</title>
</head>
<body>
    <h1>編集画面</h1>
    <form action="/posts/{{ $post->id }}" method="POST">
        @csrf
        @method('PUT')

        <!-- タイトル入力 -->
        <div class="content__title">
            <h2>タイトル</h2>
            <input type="text" name="post[title]" value="{{ $post->title }}">
            @error('post.title')
                <p>{{ $message }}</p>
            @enderror
        </div>

        <!-- 本文入力 -->
        <div class="content__body">
            <h2>本文</h2>
            <textarea name="post[body]">{{ old('post.body', $post->body) }}</textarea>
            @error('post.body')
                <p>{{ $message }}</p>
            @enderror
        </div>

        <!-- 保存ボタン -->
        <input type="submit" value="保存">
    </form>

    <!-- 戻るリンク -->
    <a href="{{ url('/posts') }}">一覧へ戻る</a>
</body>
</html>