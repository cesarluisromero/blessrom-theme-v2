/** @type {import('tailwindcss').Config} */
export default {
  content: [
    './resources/views/**/*.blade.php',
    './resources/scripts/**/*.js',
    './app/**/*.php',
    './woocommerce/**/*.php',
    './*.php',
  ],
  theme: {
    extend: {
      colors: {
        primary: '#111B2E',
        'primary-dark': '#0a101d',
      },
    },
  },
  plugins: [],
}
