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

mix.js('resources/assets/js/app.js', 'public/js')
    .sass('resources/assets/sass/app.scss', 'public/css');
mix.scripts([
    'node_modules/jquery/dist/jquery.js',
    'node_modules/bootstrap-sass/assets/javascripts/bootstrap.js',
    'resources/assets/js/ejemplo.js'
], 'public/assets/js/all.js', './');

mix.browserSync({
    proxy : 'blogudemy.dev'
});
    // .sass('resources/assets/sass/blog.scss', 'public/css');

// Sirve para combinar archivos css en uno en especifico  all.css es el arcivo por defecto si no se establece,
// la carpeta por defecto es resources/assets/css    
// mix.styles([
//     'a.css',
//     'b.css'
// ], 'public/css/c.css', 'public/css');