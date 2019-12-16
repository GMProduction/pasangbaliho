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
mix.webpackConfig({
   resolve: {
       alias: {
           'Actions': path.resolve(__dirname, 'resources/js/Actions/'),
           'Components': path.resolve(__dirname, 'resources/js/components/'),
           'Controller': path.resolve(__dirname, 'resources/js/Controller/'),
           'Page': path.resolve(__dirname, 'resources/js/Page/'),
           'Reducer': path.resolve(__dirname, 'resources/js/Reducer/'),
           'Store': path.resolve(__dirname, 'resources/js/Store/'),
           'Style': path.resolve(__dirname, 'resources/js/Style/'),
       }
   },
   output: {
       chunkFilename: mix.inProduction() ? "js/prod/chunks/[name]?id=[chunkhash].js" : "js/chunks/[name].js"
   }
}); 

mix.react('resources/js/aplikasi.js', 'public/js')
   .sass('resources/sass/app.scss', 'public/css');
