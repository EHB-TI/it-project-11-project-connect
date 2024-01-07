const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js')
   .js('resources/js/markdown.js', 'public/js')
  // .sass('resources/sass/app.scss', 'public/css')
  .postCss('resources/css/style.css', 'public/css/app.css',[
   require('tailwindcss')

])
   .version();
