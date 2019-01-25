const mix = require('laravel-mix')
const BundleAnalyzerPlugin = require('webpack-bundle-analyzer')
  .BundleAnalyzerPlugin
const CompressionPlugin = require('compression-webpack-plugin')

mix
  // 前端
  .js('resources/js/app/app.js', 'public/js')
  .sass('resources/sass/app/app.scss', 'public/css')

  // 後端
  .js('resources/js/admin/app.js', 'public/js/admin.js')
  .sass('resources/sass/admin/app.scss', 'public/css/admin.css')

  .extract()
  // .webpackConfig({
  //   plugins: [
  //     new BundleAnalyzerPlugin(),

  //   ]
  // })
  // .version()

// .options({
//   processCssUrls: false
// })

if (!mix.inProduction()) {
  mix
    .webpackConfig({
      devtool: 'source-map'
    })
    .sourceMaps()
}

mix.browserSync({
  proxy: 'localhost:8000',
  notify: false
})

mix.disableNotifications()
