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
 mix.js('resources/assets/js/corpuses/analise_lista_palavras.js', 'public/js/corpuses');
 mix.js('resources/assets/js/corpuses/analise_form.js', 'public/js/corpuses');
mix.js('resources/assets/js/corpuses/ngrams_form.js', 'public/js/corpuses');
mix.js('resources/assets/js/corpuses/form.js', 'public/js/corpuses');

//Modules and vendor
mix.js('resources/assets/js/app.js', 'public/js');

// Vendor
mix.js('vendor/uspdev/laravel-comet-theme/resources/assets/js/script.js', 'public/js')
   .sass('vendor/uspdev/laravel-comet-theme/resources/assets/sass/app.scss', 'public/css');
