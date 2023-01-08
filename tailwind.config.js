/** @type {import('tailwindcss').Config} */
module.exports = {
    content: ['./templates/**/*.html.twig', './build/**/*.{css,js}'],
    darkMode: 'class',
    important: true,
    theme: {
        fontFamily: {
            serif: ['Mulish', 'serif'],
            sans: ['Space Grotesk', 'sans-serif'],
        },
        extend: {},
    },
    plugins: [require("tailwindcss"), require("precss"), require("autoprefixer")],
}
