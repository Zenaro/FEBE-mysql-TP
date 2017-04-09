// var webpack = require('webpack');
var path = require('path');

module.exports = {
  entry: './src/main.js',
  output: {
    path: path.join(__dirname, './build'),
    filename: '[name].js',
    publicPath: '/build/'
  },
  module: {
    loaders: [{
      test: /\.css$/,
      loader: 'style!css!autoprefixer'
    }, {
      test: /\.vue$/,
      loader: 'vue-loader'
    }, {
      test: /\.scss$/,
      use: [{
        loader: 'style-loader'
      }, {
        loader: 'css-loader'
      }, {
        loader: 'sass-loader'
      }]
    }, {
      test: /\.(png|jpg|gif)$/,
      loader: 'url-loader?limit=8192'
    }, {
      test: /\.(html|tpl)$/,
      loader: 'html-loader'
    }]
  }
};