<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ブログを楽しみましょう！！</title>
    <!-- AOSライブラリのスタイル -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" rel="stylesheet">
    @vite('resources/css/app.css') <!-- Tailwind CSSのスタイルを読み込む -->
</head>
<body>
<x-app-layout>
    <!-- 戻るボタン -->
    <div class="p-4">
        <a href="{{ route('index') }}" 
           class="text-white bg-gradient-to-r from-purple-500 to-pink-500 hover:bg-gradient-to-l focus:ring-4 focus:outline-none focus:ring-purple-200 dark:focus:ring-purple-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
            ✖
        </a>
    </div>

    <!-- 星空のアニメーション -->
    <div class="relative h-screen bg-black flex flex-col items-center justify-center">
            <div class="absolute top-20 left-10 w-2 h-2 bg-white rounded-full animate-stars-twinkle"></div>
            <div class="absolute top-40 left-60 w-3 h-3 bg-white rounded-full animate-stars-twinkle"></div>
            <div class="absolute top-60 left-40 w-1 h-1 bg-white rounded-full animate-stars-twinkle"></div>
        <h2 class="text-white text-2xl mt-10">ブログを楽しみましょう！！</h2>
    </div>

    <!-- スクロールアニメーション -->
    <div data-aos="fade-right" data-aos-duration="2000" class="mt-20">
        <div class="p-4 bg-white rounded shadow-lg max-w-md mx-auto text-center">
            <h2 class="text-xl font-bold">焚き火を囲む夜</h2>
            <p class="text-gray-600 mt-4">静かな夜に心を癒やされましょう。</p>
        </div>
    </div>

    <!-- 焚き火のアニメーション -->
    <div class="relative flex justify-center items-center h-96 bg-gray-800">
        <div class="w-16 h-16 bg-orange-500 rounded-full animate-fire-flicker absolute"></div>
        <div class="w-12 h-12 bg-red-500 rounded-full animate-fire-flicker absolute top-4"></div>
    </div>
</x-app-layout>

<!-- AOSライブラリのスクリプト -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
<script>
    AOS.init({
        duration: 1200, // アニメーションの持続時間
    });
</script>
</body>
</html>
