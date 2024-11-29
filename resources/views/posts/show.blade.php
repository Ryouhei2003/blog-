<x-app-layout>
    <x-slot name="header">
        Show
    </x-slot>

    <h1>{{ $post->title }}</h1> <!-- 投稿タイトルを表示 -->
    
    <p>{{ $post->body }}</p> <!-- 投稿本文を表示 -->
    <!-- カテゴリ名を表示 -->
    <p>カテゴリ
            {{ $post->category->name }}
        </a>
    </p>

    <!-- 投稿一覧ページへのリンク -->
    <a class="font-medium text-pink-600 dark:text-pink-500 hover:underline"
 href="{{ route('index') }}">
        ブログ投稿一覧へ戻る
    </a>

    <!-- 編集ページへのリンク -->
    <div class="font-medium text-purple-600 dark:text-purple-500 hover:underline">
        <a href="/posts/{{ $post->id }}/edit">edit</a>
    </div>
</x-app-layout>