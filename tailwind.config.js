/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./assets/**/*.js",
        "./templates/**/*.html.twig",
      ],
    darkMode: 'class',
    important: true,
    theme: {
        fontFamily: {
            serif: ['Mulish', 'serif'],
            sans: ['Space Grotesk', 'sans-serif'],
        },
        extend: {},
    },
    plugins: [],
}
