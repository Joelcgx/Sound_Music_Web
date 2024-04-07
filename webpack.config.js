const path = require("path");

module.exports = {
  entry: {
    iconify: "./private/src/js/iconify.js",
  },
  output: {
    path: path.resolve(__dirname, "./public/src/js/webpack/"),
    filename: "[name].js",
  },
  mode: "development",
};
