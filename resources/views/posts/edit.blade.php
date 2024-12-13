<x-app-layout>
    <x-slot name="header">
        編集
    </x-slot>

    <div class="container mx-auto px-4">
        <h1 class="text-xl font-bold mb-4">投稿編集</h1>
        <form action="/posts/{{ $post->id }}" method="POST">
            @csrf
            @method('PUT')

            <!-- タイトル入力 -->
            <div class="mb-4">
                <label for="post_title" class="block text-sm font-medium text-blue-700 mb-1">タイトル</label>
                <input
                    type="text"
                    id="post_title"
                    name="post[title]"
                    value="{{ $post->title }}"
                    class="w-full p-2 border border-yellow-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400"
                    placeholder="タイトルを入力してください"
                >
                @error('post.title')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- 本文入力 -->
            <div class="mb-4">
                <label for="post_body" class="block text-sm font-medium text-blue-700 mb-1">本文</label>
                <textarea
                    id="post_body"
                    name="post[body]"
                    rows="5"
                    class="w-full p-2 border border-yellow-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400"
                    placeholder="本文を入力してください">{{ old('post.body', $post->body) }}</textarea>
                @error('post.body')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- 保存ボタン -->
            <div class="flex justify-center mt-4">
                <button
                    type="submit"
                    class="text-gray-900 bg-gradient-to-r from-red-200 via-red-300 to-yellow-200 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-red-100 dark:focus:ring-red-400 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                    保存
                </button>
            </div>

            <!-- 戻るボタン -->
            <div class="flex justify-center mt-4">
                <a
                    href="{{ url()->previous() }}"
                    class="text-gray-900 bg-gradient-to-r from-lime-200 via-lime-400 to-lime-500 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-lime-300 dark:focus:ring-lime-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                    戻る
                </a>
            </div>
        </form>
    </div>
</x-app-layout>
