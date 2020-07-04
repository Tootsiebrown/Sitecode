require('dotenv').config()

const path = require('path')
const { mix, config } = require('laravel-mix')

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

const standardConfig = {
    resolve: {
        modules: [
            path.resolve('./node_modules'),
            path.resolve('./resources/js'),
        ],
    }
}

const standardMix = () => mix
       .js('resources/js/main.js', 'public/js/bundle.js')
       .extract(['jquery', 'babel-polyfill'])
       .autoload({
            jquery: ['$', 'jQuery', 'window.jQuery']
        })
       .sass('resources/sass/style.scss', 'public/css')
       .sass('resources/sass/wysiwyg-styles.scss', 'public/css')
       .disableNotifications()
       .options({
            processCssUrls: false
       })

if (!mix.inProduction()) {
    mix.webpackConfig(Object.assign({}, standardConfig))

    standardMix()
        .sourceMaps()
        .browserSync({
            proxy: process.env.APP_URL,
            files: [
                'app/**/*.php',
                'resources/views/**/*.php',
                'public/js/**/*.js',
                'public/css/**/*.css'
            ]
        })
} else {
    mix.webpackConfig(standardConfig)

    standardMix().version()
}
