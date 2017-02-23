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
      loader: 'vue'
    }, {
      test: /\.scss$/,
      loader: 'style!css!sass?sourceMap'
    }, {
      test: /\.(png|jpg|gif)$/,
      loader: 'url-loader?limit=8192'
    }, {
      test: /\.(html|tpl)$/,
      loader: 'html-loader'
    }]
  }
};