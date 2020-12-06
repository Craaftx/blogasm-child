const MiniCssExtractPlugin = require("mini-css-extract-plugin");
const mode =
  process.env.NODE_ENV === "production" ? "production" : "development";

module.exports = {
  mode,
  entry: {
    style: "./sass/style.scss",
  },
  output: {
    filename: "[name].js",
    path: __dirname,
  },
  module: {
    rules: [
      {
        test: /\.scss$/,
        use: [MiniCssExtractPlugin.loader, "css-loader", "sass-loader"],
      },
    ],
  },
  plugins: [
    new MiniCssExtractPlugin({
      filename: "[name].css",
    }),
  ],
};
