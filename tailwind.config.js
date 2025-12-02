/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./assets/**/*.js",
    "./templates/**/*.html.twig",
  ],
  theme: {
    extend: {
      colors: {
        primary: {
          50: '#f5f7fa',
          100: '#ebeef3',
          200: '#d2dae5',
          300: '#adbccf',
          400: '#8197b4',
          500: '#61789c',
          600: '#4d5f82',
          700: '#3f4e6a',
          800: '#374359',
          900: '#30394c',
        },
      },
    },
  },
  plugins: [],
}
