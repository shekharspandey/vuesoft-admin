module.exports = {
    darkMode: "class",
    content: [
        "./resources/views/**/*.blade.php",
        "./resources/js/**/*.vue",
        "./resources/css/**/*.css",
    ],
    theme: {
        extend: {
            fontFamily: {
                poppins: ["Poppins", "sans-serif"],
            },
            colors: {
                heading: "var(--heading-color)",
                primary: "var(--primary-color)",
                secondary: "var(--secondary-color)",
                background: "var(--background-color)",
            },
            boxShadow: {
                custom: "rgba(0, 0, 0, 0.35) 0px 5px 15px",
            },
        },
    },
    plugins: [],
};
