import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
     darkMode: 'media',
  content: [
    "./resources/**/*.{blade.php,js}",
    "./node_modules/flowbite/**/*.js"
  ],
  plugins: [
    require('@tailwindcss/forms'),
    require('flowbite/plugin'),
  ],
};
