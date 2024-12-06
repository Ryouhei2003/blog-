<x-app-layout>
    <x-slot name="header">
         編集
    </x-slot>
    <h1>編集画面</h1>
    <form action="/posts/{{ $post->id }}" method="POST">
        @csrf
        @method('PUT')

        <!-- タイトル入力 -->
        <div class="content__title">
            <h2>タイトル</h2>
            <input type="text" name="post[title]" value="{{ $post->title }}">
            <p class="title__error" style="color:red">{{ $errors->first('post.title') }}</p>
        </div>

        <!-- 本文入力 -->
        <div class="content__body">
            <h2>本文</h2>
            <textarea name="post[body]">{{ old('post.body', $post->body) }}</textarea>
            <p class="body__error" style="color:red">{{ $errors->first('post.body') }}</p>
        </div>
        
        <!-- カテゴリ選択 -->
        <div class="カテゴリ">
            <h2>カテゴリ</h2>
            <select name="post[category_id]">
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            <p class="category__error" style="color:red">{{ $errors->first('post.category_id') }}</p>
        </div>

        <!-- 保存ボタン -->
        <div>
            <input type="submit" value="保存" style=<button type="button" class="text-gray-900 bg-gradient-to-r from-red-200 via-red-300 to-yellow-200 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-red-100 dark:focus:ring-red-400 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2"></button>
        </div>
        
        <div class="min-h-screen bg-green-100"></div>
    </form>

    <!-- 戻るリンク -->
    <a href="/">一覧へ戻る</a>
</x-app-layout>
</html>