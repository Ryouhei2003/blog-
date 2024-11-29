import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/**/*.js', // 必要に応じて追加
        './resources/**/*.vue', // 必要に応じて追加
        './resources/**/*.html',
        './public/**/*.html',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            animation: {
                'bg-pan': 'bgPan 10s infinite linear',
                'fade-in': 'fadeIn 1.5s ease-out',
                'fire-flicker': 'flicker 0.5s infinite',
                'stars-twinkle': 'twinkle 2s infinite',
            },
            keyframes: {
                bgPan: {
                    '0%': { 'background-position': '0% 50%' },
                    '100%': { 'background-position': '100% 50%' },
                },
                fadeIn: {
                    '0%': { opacity: '0', transform: 'translateY(-20px)' },
                    '100%': { opacity: '1', transform: 'translateY(0)' },
                },
                flicker: {
                    '0%, 100%': { opacity: '1' },
                    '50%': { opacity: '0.7' },
                },
                twinkle: {
                    '0%, 100%': { opacity: '1' },
                    '50%': { opacity: '0.5' },
                },
            },
        },
    },
    plugins: [
        forms, // Laravel Breeze などでフォームスタイルを有効化
    ],
};
