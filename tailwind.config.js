import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ["Helvetica Neue", ...defaultTheme.fontFamily.sans],
                serif: [
                    "Libre Baskerville",
                    ...defaultTheme.fontFamily.sans,
                ],
            },
            colors: {
                black: "#0D0D0D",
            },
        },
    },

    darkMode: "false",

    plugins: [forms],
};
