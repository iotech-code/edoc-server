let mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/assets/js/app.js', 'public/js')
   .sass('resources/assets/sass/app.scss', 'public/css')
   .js('resources/assets/js/document/index.js', 'public/js/document/index.js')
   .sass('resources/assets/sass/document/index.scss', 'public/css/document/index.css')
   .js('resources/assets/js/document/create.js', 'public/js/document/create.js')
   .sass('resources/assets/sass/document/create.scss', 'public/css/document/create.css')
   .js('resources/assets/js/document/edit.js', 'public/js/document/edit.js')
   .sass('resources/assets/sass/login.scss', 'public/css/login.css')
   .js('resources/assets/js/login.js', 'public/js/login.js')



   .js('resources/assets/js/nameSearch.js', 'public/js/nameSearch.js');

  //  .js('resources/assets/js/document/*', 'public/js/document/*');
