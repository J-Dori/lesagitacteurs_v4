/** @type {import('tailwindcss').Config} */
module.exports = {
    content: ['./templates/**/*.html.twig', './assets/**/*.{js,ts,jsx,tsx}'],
    darkMode: 'class',
    theme: {
        fontFamily: {
            serif: ['Mulish', 'serif'],
            sans: ['Space Grotesk', 'sans-serif'],
        },
        extend: {},
    },
    plugins: [require("tailwindcss"), require("precss"), require("autoprefixer")],
}
