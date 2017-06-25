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
    .sass('resources/assets/sass/app.scss', 'public/css');

if (mix.config.inProduction) {
    mix.version();
} else {
    // Temp sourceMaps() isn't working so we have to use this workaround
    // to let it know to use inline-source-map as the devtool
    mix.webpackConfig({ devtool: "inline-source-map" });
    mix.sourceMaps();
}
