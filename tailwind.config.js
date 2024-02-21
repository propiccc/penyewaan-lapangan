/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
  ],
  theme: {
    extend: {
    },
    darkMode: "media",
  },
  
  plugins: [
    require('flowbite/plugin')
  ],
}

