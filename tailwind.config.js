/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["{index.html,main.js, ./node_modules/flowbite/**/*.js}"],
  theme: {
    extend: {},
  },
  plugins: [require("flowbite/plugin")],
};
