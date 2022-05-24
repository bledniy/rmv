const mix = require('laravel-mix');

mix.options({
    processCssUrls: false
});

//Admin side

// mix.scripts([
//     'public/js/core/popper.min.js',
//     'public/js/core/bootstrap-material-design.min.js',
//     'public/js/plugins/bootstrap-notify.js',
//     'public/js/plugins/bootstrap-selectpicker.js',
//     'public/js/lib/jquery.fancybox.min.js',
//     'public/js/lib/bootstrap-filestyle.min.js',
//     'public/js/lib/Sortable.min.js',
//     'public/js/lib/lodash.js',
// ], 'public/_admin/js/libraries.js')
//     .version();
// mix.js('resources/js/admin/app.js', 'public/_admin/static/js')
//     .sourceMaps()
//     .version();
//
// mix.sass('resources/sass/material-dashboard/material-dashboard.scss', 'public/_admin/css')
//     .sass('resources/sass/admin/admin-main.scss', 'public/_admin/css')
//     .sass('resources/sass/prolite/styles.scss', 'public/_admin/css')
//     .sourceMaps();
//End Admin side

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

mix
    .sass('resources/sass/app/style.scss', 'public/static/css')
    .sass('resources/sass/app/fontawesome.scss', 'public/static/css')
    .sass('resources/sass/app/brands.scss', 'public/static/css')
    .sass('resources/sass/app/solid.scss', 'public/static/css')
    .js('resources/js/script.js', 'public/static/js')
    .sourceMaps()
    .version();
