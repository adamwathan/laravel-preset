let mix = require('laravel-mix')
require('laravel-mix-purgecss')

mix.js('resources/assets/js/app.js', 'public/js')
  .postCss('resources/assets/css/app.css', 'public/css')
  .options({
    postCss: [
      require('postcss-import')(),
      require('tailwindcss')(/* './path/to/tailwind.js' */),
      require('postcss-nesting')(),
    ]
  })
  .purgeCss()

if (mix.inProduction()) {
  mix.version()
}
