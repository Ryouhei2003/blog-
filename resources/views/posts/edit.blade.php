<!-- resources/views/posts/edit.blade.php -->
<form action="/posts/{{ $post->id }}" method="POST">
    @csrf
    @method('PUT')

    <label for="title">タイトル</label>
    <input type="text" name="title" value="{{ old('title', $post->title) }}" required>

    <label for="body">本文</label>
    <textarea name="body" required>{{ old('body', $post->body) }}</textarea>

    <button type="submit">保存</button>
    <a href="{{ url('/') }}">戻る</a>
</form>