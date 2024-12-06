<x-app-layout>
    <header>
        <link rel="stylesheet" href="{{ asset('/css/style.css') }}">
    </header>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-yellow-50 leading-tight animate-fade-in">
            Index
        </h2>
    </x-slot>

    <div class="container mx-auto px-4">
        <h1 class="text-3xl font-bold animate-fade-in text-center mt-10">
            フェードインアニメーション 🎉
        </h1>

        <a href='/posts/create'>
            <button type="button" 
                class="text-white bg-gradient-to-br from-purple-600 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                作成
            </button>
        </a>
        <style>
@keyframes flame-flicker {
    0%, 100% { transform: scale(1); }
    50% { transform: scale(1.1); }
}
.campfire {
    animation: flame-flicker 1s infinite alternate ease-in-out;
}
</style>


<style>
@keyframes move-star {
    0% { transform: translateX(0); }
    100% { transform: translateX(100vw); }
}
.star {
    position: absolute;
    top: 10%;
    animation: move-star 5s linear infinite;
}
</style>

<div class="star">
    <img src="/images/star.png" alt="星" />
</div>



        @foreach ($posts as $post)
            <div class="post p-4 bg-yellow-50 rounded shadow-lg hover:shadow-xl text-center mb-4 animate-fade-in transition-shadow duration-300">
                <h2 class="title text-xl font-medium">
                    <a href="/posts/{{ $post->id }}" class="font-medium text-green-500 hover:text-green-700">
                        {{ $post->title }}
                    </a>
                </h2>
                <p class="mt-2">カテゴリ: 
                    @if ($post->category)
                        <a href="/categories/{{ $post->category->id }}" class="text-blue-500 hover:underline">
                            {{ $post->category->name }}
                        </a>
                    @else
                        <span class="text-gray-500">未分類</span>
                    @endif
                </p>
                <p class="body mt-2 text-gray-700">{{ $post->body }}</p>

                <form action="/posts/{{ $post->id }}" id="form_{{ $post->id }}" method="post" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="button" 
                        class="text-white bg-gradient-to-r from-pink-400 via-pink-500 to-pink-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-pink-300 dark:focus:ring-pink-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2"
                        data-post-id="{{ $post->id }}">
                        削除
                    </button>
                </form>
            </div>
        @endforeach
        <div class="camp bound">
            <img src="/img/camp.png" class="absolute right-0 bottom-0 w-32 h-32 animate-bounce">
    </div>
    </div>
</x-app-layout>

    <!-- テントのバウンドアニメーション -->
    <div class="relative w-16 h-16 bg-green-500 animate-tent-bounce">
        <!-- テントの屋根 -->
        <div class="absolute bottom-0 left-0 w-0 h-0 border-l-[32px] border-r-[32px] border-b-[32px] border-l-transparent border-r-transparent border-b-green-700"></div>
    </div>

    <!-- テキスト -->
    <h2 class="text-white text-2xl mt-10">キャンプを楽しみましょう</h2>
</div>

<div class="bg-blue-500 text-white p-4 text-center">
    Tailwindが動いています！
</div>


<script>
    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('button[data-post-id]').forEach(button => {
            button.addEventListener('click', () => {
                const postId = button.dataset.postId;
                if (confirm('削除すると復元できません。\n本当に削除しますか？')) {
                    document.getElementById(`form_${postId}`).submit();
                }
            });
        });
    });
</script>
