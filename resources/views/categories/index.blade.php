<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>Blog</title>
    <script>
        function deletePost(id) {
            'use strict';
            if (confirm('本当に削除しますか？')) {
                document.getElementById(`form_${id}`).submit();
            }
        }
    </script>
</head>
<body>
    <h1>index画面</h1>
    <a href='/posts/create'>create</a>
    <div class='posts'>
        @foreach ($posts as $post)
            <div class='post'>
                <h2 class='title'>
                    <a href="/posts/{{ $post->id }}">{{ $post->title }}</a>
                </h2>
                <!-- カテゴリ名をリンクで表示 -->
                <p>カテゴリ: <a href="/categories/{{ $post->category->id }}">{{ $post->category->name }}</a></p>
                <p class='body'>{{ $post->body }}</p>
                <!-- 投稿の削除フォーム -->
                <form action="/posts/{{ $post->id }}" id="form_{{ $post->id }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="button" onclick="deletePost({{ $post->id }})">delete</button>
                </form>
            </div>
        @endforeach
    </div>
    <div class='paginate'>
        {{ $posts->links() }}
    </div>
    <a href="/">戻る</a>
</body>
</html>