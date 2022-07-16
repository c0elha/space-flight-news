const defaultTheme = require("tailwindcss/defaultTheme");

module.exports = {
  content: ["./index.html", "./src/**/*.{vue,js,ts,jsx,tsx}"],
  theme: {
    extend: {
      fontFamily: {
        sans: ["Roboto Condensed", ...defaultTheme.fontFamily.sans],
      },
      colors: {
        transparent: "transparent",
        current: "currentColor",
        black: "#1e2022",
        white: "#ffffff",
        primary: "#302e53",
        purple: "#302e53",
        secondary: "#d07017",
      },
    },
  },
  plugins: [],
};
