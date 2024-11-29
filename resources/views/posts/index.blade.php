<x-app-layout>
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
            <button type="button" class="text-white bg-gradient-to-r from-purple-500 to-pink-500 hover:bg-gradient-to-l focus:ring-4 focus:outline-none focus:ring-purple-200 dark:focus:ring-purple-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 animate-fade-in">
                create
            </button>
        </a>

        @foreach ($posts as $post)
            <div class="post p-4 bg-yellow-50 rounded shadow-lg hover:shadow-xl text-center mb-4 animate-fade-in transition-shadow duration-300">
                <h2 class="title text-xl font-medium">
                    <a href="/posts/{{ $post->id }}" class="font-medium text-green-500 hover:text-green-700">
                        {{ $post->title }}
                    </a>
                </h2>
                <p>カテゴリ: 
                    @if ($post->category)
                        <a href="/categories/{{ $post->category->id }}
                            {{ $post->category->name }}
                        </a>
                    @else
                        <span class="text-gray-500">未分類</span>
                    @endif
                </p>
                <p class="body mt-2 text-yellow-50">{{ $post->body }}</p>

                <form action="/posts/{{ $post->id }}" id="form_{{ $post->id }}" method="post" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="button" 
                            class="text-white bg-red-500 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 transition-transform transform hover:scale-105" 
                            data-post-id="{{ $post->id }}">
                        delete
                    </button>
                </form>
            </div>
        @endforeach
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
