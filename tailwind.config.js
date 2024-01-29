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
        container: {
            center: true,
            padding: {
                DEFAULT: "1rem",
                sm: "2rem",
                lg: "4rem",
                xl: "6rem",
                "2xl": "8rem",
            },
        },
        fontFamily: {
            body: ["'DM Sans'", "sans-serif"],
        },
    },
    daisyui: {
        themes: [
            {
                light: {
                    ...require("daisyui/src/theming/themes").light,
                    primary: "#EFE9E4",
                    "primary-content": "#000000",
                    secondary: "#494949",
                    neutral: "#333333",
                    info: "#00e1ff",
                    success: "#90ca27",
                    warning: "#ff8800",
                    error: "#ff7f7f",
                    "--rounded-box": "0.25rem",
                    "--rounded-btn": "0.25rem",
                },
                dark: {
                    ...require("daisyui/src/theming/themes").dark,
                    primary: "#EFE9E4",
                    "primary-content": "#000000",
                    secondary: "#494949",
                    neutral: "#333333",
                    info: "#00e1ff",
                    success: "#90ca27",
                    warning: "#ff8800",
                    error: "#ff7f7f",
                    "base-100": "#A97561",
                    "base-200": "#1e2328",
                    "base-300": "#28323c",
                    "base-content": "#dcebfa",
                    "--rounded-box": "0.25rem",
                    "--rounded-btn": "0.25rem",
                },
            },
        ],
    },
    plugins: [forms, require("daisyui")],
};
