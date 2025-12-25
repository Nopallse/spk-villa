import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

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
                primary: {
                    50: '#f0fafa',
                    100: '#d9f2f2',
                    200: '#b8e6e6',
                    300: '#87d4d4',
                    400: '#4fb8b8',
                    500: '#1ba7a7',
                    600: '#178888',
                    700: '#166b6b',
                    800: '#175757',
                    900: '#184949',
                    950: '#082b2b',
                },
            },
        },
    },

    plugins: [forms],
};
