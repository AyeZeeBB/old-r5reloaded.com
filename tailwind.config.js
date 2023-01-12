/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    '**/*.{php,js,html}',
  ],
  theme: {
    extend: {
      fontFamily: {
        segoeui: ['Segoe UI', 'Tahoma', 'Geneva', 'Verdana', 'sans-serif'],
      }
    },
  },
  plugins: [],
}
