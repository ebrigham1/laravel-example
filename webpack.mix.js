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

// Autoload jquery for other vendor libs that require it (bootstrap)
mix.autoload({
    'jquery': ['window.jQuery', 'jQuery', '$']
});

mix.js('resources/assets/js/app.js', 'public/js')
    .extract(
        [
            'axios',
            'jquery',
            'bootstrap-sass',
            'lodash',
            'normalize-scss',
            'select2',
            'bootstrap-hover-dropdown',
            'bootstrap-confirmation2/bootstrap-confirmation'
        ]
    )
    .js('resources/assets/js/activityLog.js', 'public/js')
    .sass('resources/assets/sass/app.scss', 'public/css');

if (mix.config.inProduction) {
    mix.version();
} else {
    mix.sourceMaps();
}
