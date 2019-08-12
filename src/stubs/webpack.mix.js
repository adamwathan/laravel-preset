let mix = require('laravel-mix')
require('laravel-mix-purgecss')

mix.js('resources/js/app.js', 'public/js')
  .postCss('resources/css/app.css', 'public/css')
  .options({
    postCss: [
      require('postcss-import')(),
      require('tailwindcss'),
      require('postcss-nesting')(),
      require('autoprefixer'),
    ]
  })
  .purgeCss()

if (mix.inProduction()) {
  mix.version()
}
