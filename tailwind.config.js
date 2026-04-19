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
        primary: '#4f46e5',
        'primary-dark': '#4338ca',
      },
    },
  },
  plugins: [],
}
