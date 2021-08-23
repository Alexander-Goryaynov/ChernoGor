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

mix.js('resources/js/app.js', 'public/js')
    .vue()
    .sass('resources/sass/app.scss', 'public/css')
    .scripts([
        'resources/js/scripts/jquery/jquery.js',
        'resources/js/scripts/accordions.js',
        'resources/js/scripts/custom.js',
        'resources/js/scripts/jquery.singlePageNav.min.js',
        'resources/js/scripts/owl.js',
        'resources/js/scripts/slick.js',
    ], 'public/js/all.js');

mix.styles([
    'resources/css/flex-slider.css',
    'resources/css/look.css',
    'resources/css/owl.css',
], 'public/css/all.css');

mix.copyDirectory('resources/fonts', 'public/fonts');
mix.copyDirectory('resources/images', 'public/images');
