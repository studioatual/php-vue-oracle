/* eslint-disable */

const path = require('path');
const webpack = require('webpack');
const VueLoaderPlugin = require('vue-loader/lib/plugin');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const OptimizeCSSAssetsPlugin = require('optimize-css-assets-webpack-plugin');
const TerserPlugin = require('terser-webpack-plugin');
const HtmlWebpackPlugin = require('html-webpack-plugin');
const BrowserSyncPlugin = require('browser-sync-webpack-plugin');
const { CleanWebpackPlugin } = require('clean-webpack-plugin');

const isDevelopment = process.env.NODE_ENV === 'development';

require('dotenv').config();

module.exports = {
  mode: process.env.NODE_ENV,
  watch: isDevelopment,
  watchOptions: {
    aggregateTimeout: 500,
    ignored: ['node_modules'],
  },
  resolve: {
    alias: {
      '~': path.resolve(__dirname, 'resources', 'js'),
    },
    extensions: ['.js', '.vue', '.scss', '.json'],
  },
  entry: path.resolve(__dirname, 'resources', 'js', 'index.js'),
  output: {
    filename: isDevelopment ? 'js/app.js' : 'js/app.[contenthash].js',
    path: isDevelopment
      ? path.resolve(__dirname, 'public')
      : path.resolve(__dirname, 'public'),
    publicPath: '/',
  },
  module: {
    rules: [
      {
        enforce: 'pre',
        test: /\.(js\vue)$/,
        loader: 'eslint-loader',
        exclude: /node_modules/,
        options: {
          fix: false,
          failOnWarning: true,
        },
      },
      {
        test: /\.vue$/,
        use: {
          loader: 'vue-loader',
          options: {
            sourceMap: isDevelopment,
            extract: false,
          },
        },
      },
      {
        test: /\.m?js$/,
        exclude: /(node_modules|bower_components)/,
        use: {
          loader: 'babel-loader',
          options: {
            presets: ['@babel/preset-env'],
            plugins: ['@babel/plugin-transform-runtime'],
          },
        },
      },
      {
        test: /\.(sa|sc|c)ss$/,
        use: [
          MiniCssExtractPlugin.loader,
          { loader: 'css-loader', options: {} },
          {
            loader: 'postcss-loader',
            options: {
              ident: 'postcss',
              plugins: [require('autoprefixer')()],
            },
          },
          { loader: 'sass-loader', options: {} },
        ],
      },
      {
        test: /\.(png|jpg|gif|svg)$/,
        use: [
          {
            loader: 'file-loader',
            options: {
              name: '[name].[ext]?[hash]',
              outputPath: 'img',
              publicPath: '/img',
            },
          },
        ],
      },
      {
        test: /\.(woff(2)?|ttf|eot)(\?v=\d+\.\d+\.\d+)?$/,
        use: [
          {
            loader: 'file-loader',
            options: {
              name: '[name].[ext]?[hash]',
              outputPath: 'fonts',
              publicPath: '/fonts',
            },
          },
        ],
      },
    ],
  },
  plugins: [
    new CleanWebpackPlugin({
      cleanOnceBeforeBuildPatterns: ['css/*', 'js/*', 'img/*', 'fonts/*'],
    }),
    new VueLoaderPlugin(),
    new HtmlWebpackPlugin({
      template: path.resolve(
        __dirname,
        'resources',
        'js',
        'static',
        'index.html'
      ),
      filename: '../resources/views/index.html',
    }),
    new MiniCssExtractPlugin({
      filename: isDevelopment ? 'css/style.css' : 'css/style.[contenthash].css',
    }),
    new BrowserSyncPlugin({
      host: 'localhost',
      port: 3000,
      proxy: 'http://localhost',
      files: ['public/js/*.js', 'public/css/*.css'],
    }),
    new webpack.DefinePlugin({
      'process.env': {
        API_URL: isDevelopment
          ? JSON.stringify(process.env.DEV_URL)
          : JSON.stringify(process.env.PROD_URL),
      },
    }),
  ],
  optimization: isDevelopment
    ? {}
    : {
        minimizer: [
          new TerserPlugin({
            terserOptions: {
              output: {
                comments: false,
              },
            },
          }),
          new OptimizeCSSAssetsPlugin({
            cssProcessorPluginOptions: {
              preset: ['default', { discardComments: { removeAll: true } }],
            },
          }),
        ],
      },
};

/* eslint-enable */
