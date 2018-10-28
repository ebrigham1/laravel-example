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

// Autoload jquery for other vendor libs that require it (bootstrap)
mix.autoload({
    'jquery': ['window.jQuery', 'jQuery', '$']
});

mix.react('resources/js/app.js', 'public/js')
    .extract(
        [
            'axios',
            'jquery',
            'bootstrap',
            'lodash',
            'select2',
            'bootstrap-hover-dropdown',
            'bootstrap-confirmation2/dist/bootstrap-confirmation',
            'react',
            'react-dom',
            'babel-preset-react/lib',
            'infinite-scroll/js'
        ]
    )
    .react('resources/js/activityLog.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css');

if (mix.config.inProduction) {
    mix.version();
} else {
    mix.webpackConfig({
        devtool: 'source-map'
    }).sourceMaps();
}
