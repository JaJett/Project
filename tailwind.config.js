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
                background: '#cce0e6', // Biru muda dari background logo
                darktext: '#5a3d27',   // Cokelat tua dari teks "Twice Dulu Biar Waras"
                caramel: '#db9d5c',    // Warna karamel bagian atas kue
                cream: '#f8e8d6',      // Krim terang bagian isi kue
                accent: '#a4693a',     // Alternatif cokelat tengah kue
            },
        },
    },

    plugins: [forms],
};
