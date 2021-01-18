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
    .sass('resources/sass/app.scss', 'public/css');

mix.styles([
    'resources/css/bootstrap.min.css',
    'resources/css/font-awesome.min.css',
    'resources/css/owl/*.css',
    'resources/css/normalize.css',
    'resources/css/main.css',
    'resources/css/educate-custon-icon.css',
    'resources/css/meanmenu.min.css',
    'resources/css/jquery.mCustomScrollbar.min.css',
    'resources/css/metisMenu/*.css',
    'resources/css/style.css',
    'resources/css/responsive.css',
    'resources/css/jsgrid.min.css',
    'resources/css/jsgrid-theme.min.css',
], 'public/css/all.css');

mix.scripts([
    'resources/js/modernizr-2.8.3.min.js',
    'resources/js/jquery-1.12.4.min.js',
    'resources/js/bootstrap.min.js',
    'resources/js/wow.min.js',
    'resources/js/jquery-price-slider.js',
    'resources/js/jquery.meanmenu.js',
    'resources/js/owl.carousel.min.js',
    'resources/js/jquery.sticky.js',
    'resources/js/jquery.scrollUp.min.js',
    'resources/js/counterup/jquery.counterup.min.js',
    'resources/js/counterup/waypoints.min.js',
    'resources/js/counterup/counterup-active.js',
    'resources/js/scrollbar/*.js',
    'resources/js/metisMenu/metisMenu.min.js',
    'resources/js/metisMenu/metisMenu-active.js',
    'resources/js/plugins.js',
    'resources/js/main.js',
    'resources/js/jsgrid.min.js',
    'resources/js/jsgrid.custom.js',
], 'public/js/all.js');
