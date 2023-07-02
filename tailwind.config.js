/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      colors: {
        deepWater: '#128277', // Замените #ff0000 на ваш желаемый цвет в формате HEX, RGB или название цвета.
        creamy: '#FCEEC0',
        
      },
    },
  },
  plugins: [],
}

