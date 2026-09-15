/** @type {import('tailwindcss').Config} */
export default {
    content: ["./resources/**/*.blade.php", "./resources/**/*.js"],
    theme: {
        extend: {
            colors: {
                "imersa-deep": "#004B8F",
                "imersa-gem": "#00A3E0",
                "imersa-light": "#B2DFFD",
                "imersa-bg": "#F5F7FA",
            },
            fontFamily: {
                sans: ["Inter", "Poppins", "sans-serif"],
            },
        },
    },
    plugins: [require("@tailwindcss/forms")],
};
