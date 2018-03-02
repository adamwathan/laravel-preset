let mix = require('laravel-mix')
require('laravel-mix-purgecss')

mix.js('resources/assets/js/app.js', 'public/js')
  .postCss('resources/assets/css/app.css', 'public/css')
  .options({
    postCss: [
      require('postcss-import')(),
      require('tailwindcss')(),
      require('postcss-cssnext')({
        // Mix adds autoprefixer already, don't need to run it twice
        features: { autoprefixer: false }
      }),
    ]
  })

if (mix.inProduction()) {
    mix.purgeCss()
      .version()
}
