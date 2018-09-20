const mix = require('laravel-mix');

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
mix.js('vendor/uspdev/laravel-comet-theme/resources/assets/js/script.js', 'public/js')
   .sass('vendor/uspdev/laravel-comet-theme/resources/assets/sass/app.scss', 'public/css');

 mix.styles([
     'public/css/app.css',
     'vendor/uspdev/laravel-comet-theme/resources/assets/css/style.css',
 ], 'public/css/app.css');
