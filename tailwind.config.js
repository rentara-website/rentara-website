/** @type {import('tailwindcss').Config} */
module.exports = {
  darkMode: 'class',
  
  content: [
    './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
    './vendor/laravel/jetstream/**/*.blade.php',
    './storage/framework/views/*.php',
    "./resources/**/*.{blade.php,js,vue}",
    "./index.html",
    "./src/**/*.{js,ts,jsx,tsx}",
    './vendor/ddfsn/blade-components/resources/**/*.blade.php',
  ],
  theme: {
    extend: {
      fontFamily: {
        sans: ['Poppins', 'sans-serif'],
      },
      backgroundImage:{
        'motorbike': "url('/images/OAYXH40.jpg')",
      },
    },
  },
  plugins: [
    require('@tailwindcss/forms'),
    require('@tailwindcss/typography'),
  ],
}
