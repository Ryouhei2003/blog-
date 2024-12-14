<x-app-layout>
    <x-slot name="header">
        <h1 class="text-lg font-bold text-gray-700">投稿詳細</h1>
    </x-slot>

    <!-- 投稿タイトルと本文 -->
    <div class="flex justify-center items-center mt-4">
        <div class="bg-yellow-50 border-2 border-yellow-400 p-4 rounded-lg shadow-md mb-4">
            <h1 class="text-xl font-semibold text-green-700 mb-2">{{ $post->title }}</h1>
            <p class="text-base text-gray-800">{{ $post->body }}</p>
            <p class="text-sm text-gray-500 mt-4">投稿者: {{ $post->user->name }}</p>
            <p class="text-sm text-gray-500">作成日時: {{ $post->created_at->format('Y-m-d H:i') }}</p>
        </div>
    </div>

    <!-- いいね機能 -->
    <div class="flexbox">
        @auth
            @if($post->isLikedByAuthUser())
                <i class="fa-solid fa-star like-btn liked" id="{{ $post->id }}"></i>
            @else
                <i class="fa-solid fa-star like-btn" id="{{ $post->id }}"></i>
            @endif
            <p class="count-num">{{ $post->likes->count() }}</p>
        @endauth
        

        <!-- リセットボタン -->
@auth
    <button id="reset-likes-btn" data-post-id="{{ $post->id }}" 
        class="bg-red-500 text-white px-4 py-2 mt-4 rounded hover:bg-red-700">
        いいねをリセット
    </button>
@endauth

        @guest
            <p class="text-red-500 text-lg">ログインしていません</p>
        @endguest
    </div>

    <!-- コメント一覧 -->
    <div class="py-12">
    <h3 class="text-lg font-bold">コメント一覧</h3>
    @foreach($post->comments as $comment)
        <div class="bg-orange-100 p-4 mb-4 rounded shadow">
            <p class="text-black">{{ $comment->body }}</p> <!-- 黒色にする -->
            <p class="text-sm text-gray-500">投稿者: {{ $comment->user->name }} | {{ $comment->created_at->format('Y-m-d H:i') }}</p>
        </div>
    @endforeach
</div>



    <!-- コメント投稿フォーム -->
    @auth
    <form action="{{ route('comments.store', $post) }}" method="POST" class="mt-6">
    @csrf
    <textarea name="body" rows="4" class="w-full p-2 border rounded" placeholder="コメントを入力..." required></textarea>
    <button type="submit" class="bg-green-500 text-white px-4 py-2 mt-2 rounded hover:bg-black 600">
    コメントを投稿する
    </button>
    @endauth
</form>



    @guest
        <p class="text-red-500 text-lg mt-6">コメントを投稿するにはログインしてください。</p>
    @endguest

    <!-- リンク -->
    <div class="flex space-x-4 mt-4">
        <a href="{{ route('index') }}">
            <button type="button" class="text-white bg-gradient-to-br from-purple-600 to-blue-500 hover:bg-gradient-to-bl font-medium rounded-lg text-sm px-5 py-2.5">
                戻る
            </button>
        </a>
        @auth
        <a href="/posts/{{ $post->id }}/edit">
            <button type="button" class="text-white bg-gradient-to-r from-purple-500 to-purple-700 hover:bg-gradient-to-br font-medium rounded-lg text-sm px-5 py-2.5">
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
            await fetch('/post/like', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                },
                body: JSON.stringify({ post_id: postId }),
            })
            .then(res => res.json())
            .then(data => {
                clickedEl.nextElementSibling.innerHTML = data.likesCount;
            })
            .catch(() => {
                alert('通信に失敗しました。再試行してください。');
            });
        });
    </script>
     <script>
       document.addEventListener('DOMContentLoaded', () => {
    const resetLikesBtn = document.getElementById('reset-likes-btn');

    if (resetLikesBtn) {
        resetLikesBtn.addEventListener('click', async () => {
            const postId = resetLikesBtn.getAttribute('data-post-id');

            if (!confirm('本当にいいねをリセットしますか？')) {
                return;
            }

            try {
                const response = await fetch(`/posts/${postId}/likes/reset`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    },
                });

                const data = await response.json();
                if (response.ok) {
                    document.querySelector('.count-num').textContent = data.likesCount;
                    alert(data.message);
                } else {
                    console.error(data.error);
                    alert('いいねのリセットに失敗しました。');
                }
            } catch (error) {
                console.error('エラー:', error);
                alert('通信エラーが発生しました。');
            }
        });
    }
});
     </script>
</x-app-layout>
