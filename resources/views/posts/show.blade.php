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
        <p>loginしていません</p>
    @endguest
  
    <!-- 投稿一覧ページへのリンク -->
    <a class="font-medium text-pink-600 dark:text-pink-500 hover:underline"
 href="{{ route('index') }}">
        ブログ投稿一覧へ戻る
    </a>

    <!-- 編集ページへのリンク -->
    <div class="font-medium text-purple-600 dark:text-purple-500 hover:underline">
        <a href="/posts/{{ $post->id }}/edit">編集</a>
    </div>
    <script>
    //いいねボタンのhtml要素を取得します。
        const likeBtn = document.querySelector('.like-btn');
        //いいねボタンをクリックした際の処理を記述します。 
        likeBtn.addEventListener('click',async(e)=>{
            //クリックされた要素を取得しています。
            const clickedEl = e.target
            //クリックされた要素にlikedというクラスがあれば削除し、なければ付与します。これにより星の色の切り替えができます。      
            clickedEl.classList.toggle('liked')
            //記事のidを取得しています。
            const postId = e.target.id
            //fetchメソッドを利用し、バックエンドと通信します。非同期処理のため、画面がかくついたり、真っ白になることはありません。
            const res = await fetch('/post/like',{
                //リクエストメソッドはPOST
                method: 'POST',
                headers: {
                    //Content-Typeでサーバーに送るデータの種類を伝える。今回はapplication/json
                    'Content-Type': 'application/json',
                    //csrfトークンを付与
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                //バックエンドにいいねをした記事のidを送信します。
                body: JSON.stringify({ post_id: postId })
            })
            .then((res)=>res.json())
            .then((data)=>{
                //記事のいいね数がバックエンドからlikesCountという変数に格納されて送信されるため、それを受け取りビューに反映します。
                clickedEl.nextElementSibling.innerHTML = data.likesCount;
            })
            .catch(
            //処理がなんらかの理由で失敗した場合に実施したい処理を記述します。
            ()=>alert('処理が失敗しました。画面を再読み込みし、通信環境の良い場所で再度お試しください。'))

        })
    </script>
</x-app-layout>