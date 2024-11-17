const path = require('path');

module.exports = {
  context:__dirname,
  entry: './plugin/ts/calendar.ts',
  output: {
    filename: 'bundle.js',  
    path: path.resolve(__dirname, 'dist'),
    publicPath:'/dist'
  },
  module:{
    rules:[
      {
        test:/\.ts$/,
        exclude:/node_modules/,
        use:{
          loader:'ts-loader'
        }
      }
    ]
  },
  performance: {
    hints: false,
    maxEntrypointSize: 512000,
    maxAssetSize: 512000
},
  resolve:{
    extensions: ['.ts','.js']
  },

};
