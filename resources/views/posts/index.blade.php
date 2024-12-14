<x-app-layout>
    <header>
        <link rel="stylesheet" href="{{ asset('/css/style.css') }}">
    </header>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-yellow-50 leading-tight animate-fade-in">
            　　　　　　　　　　　　　　　　　　　　　　　　　　　　日常投稿ブログ
        </h2>
    </x-slot>
@auth
    <div class="flex justify-center items-center mt-4">
        <a href='/posts/create'>
        <button type="button" 
        class="text-white bg-gradient-to-br from-purple-600 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                作成
            </button>
        </a>
    </div>
    @endauth
    @guest
    <div class="flex justify-center items-center mt-4">
       <P class = "text-red-600">新規作成をするためにログインしてください</P>
    </div>
    @endguest
        <style>
@keyframes flame-flicker {
    0%, 100% { transform: scale(1); }
    50% { transform: scale(1.1); }
}
.campfire {
    animation: flame-flicker 1s infinite alternate ease-in-out;
}
</style>
<div class="container mx-auto px-4">
    <h1 class="text-3xl font-bold animate-fade-in text-center mt-10"></h1>
    <div>
    <form action="{{ route('posts.index') }}" method="GET">
    
    @csrf
    <div class="flex justify-center items-center mt-4">
        <input type="text" name="keyword" value="{{ $keyword }}">
        <input type="submit" value="検索" class="text-white bg-gradient-to-r from-teal-400 via-teal-500 to-teal-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-teal-300 dark:focus:ring-teal-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
    </div>
</form>





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
.star img { 
    width: 50px; /* 幅を指定 */
    height: auto; /* アスペクト比を保つ */ 
}
</style>

<div class="star">
    <img src="/img/star.png" >
</div>



        @foreach ($posts as $post)
            <div class="post p-4 bg-yellow-50 rounded shadow-lg hover:shadow-xl text-center mb-4 animate-fade-in transition-shadow duration-300">
                <h2 class="title text-xl font-medium">
                    <a href="/posts/{{ $post->id }}" class="font-medium text-green-500 hover:text-green-700">
                        {{ $post->title }}
                    </a>
                </h2>
                
                <P class="text-indigo-700">{{ $post->created_at}}</P>
                <P class="text-orange-600">{{$post->user->name}}</P>
                <p class="body mt-2 text-gray-700">{{ $post->body }}</p>
                @auth
                <form action="/posts/{{ $post->id }}" id="form_{{ $post->id }}" method="post" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="button" 
                        class="text-white bg-gradient-to-r from-pink-400 via-pink-500 to-pink-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-pink-300 dark:focus:ring-pink-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2"
                        data-post-id="{{ $post->id }}">
                        削除
                    </button>
                </form>
                @endauth
            </div>
        @endforeach
        <div class="camp bound">
            <img src="/img/camp.png" class="absolute right-0 bottom-0 w-32 h-32 animate-bounce">
    </div>
     <!-- テントのバウンドアニメーション -->
     <div class="relative w-16 h-16 bg-green-500 animate-tent-bounce">
        <!-- テントの屋根 -->
        <div class="absolute bottom-0 left-0 w-0 h-0 border-l-[32px] border-r-[32px] border-b-[32px] border-l-transparent border-r-transparent border-b-green-700"></div>
    </div>
    </div>

    <style>
    .visit-counter {
        position: absolute; /* 親要素の相対位置を基準に配置 */
        top: 150px; /* 検索ボックスの下に配置 */
        right: 20px; /* 親要素の右端に近づける */
        background-color: rgba(255, 255, 255, 0.8);
        border: 1px solid #ccc;
        border-radius: 5px;
        padding: 10px 15px;
        font-size: 14px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        z-index: 1000; /* 他の要素と重ならないように */
    }
</style>





<!-- 訪問カウンタ-->
<div class="visit-counter">
    現在の訪問回数: {{ $visitCount }}
</div>

</x-app-layout>






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
