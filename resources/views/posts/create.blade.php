<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>新規作成画面</title>
    @vite('resources/css/app.css') <!-- Tailwind CSS用 -->
</head>
<body>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            新規投稿作成
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <h1 class="text-2xl font-bold mb-4">新規作成画面</h1>
        <form action="/posts" method="POST" class="space-y-4">
            @csrf
            
            <!-- タイトル入力 -->
            <div>
                <label for="title" class="block text-sm font-medium text-gray-700">タイトル</label>
                <input 
                    type="text" 
                    id="title" 
                    name="post[title]" 
                    placeholder="タイトル" 
                    value="{{ old('post.title') }}" 
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                />
                @error('post.title')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- 本文入力 -->
            <div>
                <label for="body" class="block text-sm font-medium text-gray-700">本文</label>
                <textarea 
                    id="body" 
                    name="post[body]" 
                    placeholder="今日も1日お疲れさまでした。" 
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                >{{ old('post.body') }}</textarea>
                @error('post.body')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- カテゴリ選択 -->
            <div>
                <label for="category_id" class="block text-sm font-medium text-gray-700">カテゴリ</label>
                <select 
                    id="category_id" 
                    name="post[category_id]" 
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                >
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                @error('post.category_id')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- ボタン -->
            <div class="flex space-x-4">
            <button 
            type="submit" 
            class="text-black bg-gradient-to-r from-teal-200 to-lime-200 hover:shadow-lg hover:scale-105 focus:ring-4 focus:outline-none focus:ring-lime-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center transition duration-200 ease-in-out"
>
            作成
            </button>


                <a 
            href="{{ route('index') }}" 
            class="text-black bg-gradient-to-r from-cyan-400 via-cyan-500 to-cyan-600 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center"
                >
                    戻る
                </a>
            </div>
        </form>
    </div>
</x-app-layout>
</body>
</html>
