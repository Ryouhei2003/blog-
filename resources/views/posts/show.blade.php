<x-app-layout>
    <x-slot name="header">
        <h1 class="text-lg font-bold text-gray-700">Show</h1>
    </x-slot>

   <!-- 投稿タイトルと本文 -->
<div class="flex justify-center items-center mt-4">
    <div class="bg-yellow-50 border-2 border-yellow-400 p-4 rounded-lg shadow-md mb-4">
        <h1 class="text-xl font-semibold text-green-700 mb-2">{{ $post->title }}</h1>
        <p class="text-base text-gray-800">{{ $post->body }}</p>
    </div>
</div>

        

    <!-- カテゴリ名 -->
    <p class="text-lg text-gray-600 mb-4">
        カテゴリ: <span class="font-semibold">{{ $post->category->name }}</span>
    </p>

    <!-- いいね機能 -->
    <div><p>{{$post->content}}</p></div> 
    {{-- @authはログイン済ユーザーのみに閲覧できるものを中に定義できます。 --}}
    @auth
        {{-- 前章のPostモデルで作成したメソッドを利用し、自身がこの記事にいいねしたのか判定します。 --}}
        @if($post->isLikedByAuthUser())
            {{-- こちらがいいね済の際に表示される方で、likedクラスが付与してあることで星に色がつきます --}}
            <div class="flexbox">
                <i class="fa-solid fa-star like-btn liked" id={{$post->id}}></i>
                <p class="count-num">{{$post->likes->count()}}</p>
            </div>
        @else
            <div class="flexbox">
                <i class="fa-solid fa-star like-btn" id={{$post->id}}></i>
                <p class="count-num">{{$post->likes->count()}}</p>
            </div>
        @endif
    @endauth

    @guest
        <p class="text-red-500 text-lg">ログインしていません</p>
    @endguest

    <!-- リンク -->
    <div class="flex space-x-4 mt-4">
        <a href="{{ route('index') }}" class="text-blue-600 text-lg hover:underline">
            
            <button type="button" 
        class="text-white bg-gradient-to-br from-purple-600 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
        戻る
            </button>
        </a>
        @auth
        <a href="/posts/{{ $post->id }}/edit" class="text-purple-600 text-lg hover:underline">
        <button type="button" class="text-white bg-gradient-to-r from-purple-500 via-purple-600 to-purple-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-purple-300 dark:focus:ring-purple-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
        編集 
    </button>
        
        </a>
        @endauth
    </div>

    <!-- JavaScript -->
    <script>
        const likeBtn = document.querySelector('.like-btn');
        likeBtn.addEventListener('click', async (e) => {
            const clickedEl = e.target;
            clickedEl.classList.toggle('liked');
            const postId = e.target.id;
            const res = await fetch('/post/like', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                },
                body: JSON.stringify({ post_id: postId }),
            })
                .then((res) => res.json())
                .then((data) => {
                    clickedEl.nextElementSibling.innerHTML = data.likesCount;
                })
                .catch(() =>
                    alert('処理が失敗しました。画面を再読み込みし、通信環境の良い場所で再度お試しください。')
                );
        });
    </script>
</x-app-layout>
