import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.js',
    ],
    theme: {
        extend: {
            colors: {
                ink: '#111111',
                paper: '#ffffff',
                silver: '#c9c9c9',
                gold: '#b79a5a',
            },
            fontFamily: {
                serif: ['"Zaloga"', 'Georgia', 'serif'],
                zaloga: ['"Zaloga"', 'serif'],
                sans: ['"Poppins"', '"Inter"', 'sans-serif'],
            },
            letterSpacing: {
                widest2: '0.35em',
            },
        },
    },
    plugins: [forms],
};
