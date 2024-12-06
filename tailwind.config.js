import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
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
                'flame-flicker': 'flame-flicker 1s infinite alternate ease-in-out',
                'wind-flow': 'wind-flow 10s linear infinite',
                'tent-bounce': 'tent-bounce 1.5s ease-in-out infinite',
                'button-hover': 'buttonHover 0.3s ease-in-out',
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
                'flame-flicker': {
                    '0%, 100%': { transform: 'scale(1)' },
                    '50%': { transform: 'scale(1.1)' },
                },
                'wind-flow': {
                    '0%': { backgroundPosition: '0% 0%' },
                    '100%': { backgroundPosition: '200% 100%' },
                },
                'tent-bounce': {
                    '0%, 100%': { transform: 'translateY(0)' },
                    '50%': { transform: 'translateY(-20px)' },
                },
                buttonHover: {
                    '0%': { transform: 'scale(1)' },
                    '50%': { transform: 'scale(1.1)' },
                    '100%': { transform: 'scale(1)' },
                },
            },
        },
    },

    plugins: [
        forms, // Laravel Breeze などでフォームスタイルを有効化
    ],
};
