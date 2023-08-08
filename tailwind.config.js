import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

const scrollbar = require('tailwind-scrollbar');

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },

            colors: {
                "unica-color":"#0D0D84",
                "btn-yellow": "#ffd800",
                "btn-orange": "#ff7e29",
                "btn-green": "#06ff4b",
                "btn-blue": "#00caff",
                "btn-red": "#fb0a0a",
            }
        },
    },

    plugins: [
        forms,
        scrollbar,
    ],
};
