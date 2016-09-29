var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */
var paths = {
    jquery: './node_modules/jquery/',
    bootstrap: './node_modules/bootstrap-sass/assets/',
    font_awesome: './node_modules/font-awesome/'
};
elixir.config.sourcemaps = false;
elixir(function(mix) {
    mix.sass('app.scss')
        .scripts([
            paths.jquery + 'dist/jquery.js',
            paths.bootstrap + 'javascripts/bootstrap.js'
        ], 'public/js/app.js')
        .scripts('custom.js', 'public/js/custom.js')
        .scripts('admin_categories.js', 'public/js/admin_categories.js')
        .scripts('admin_lessons.js', 'public/js/admin_lessons.js')
        .scripts('admin_answers.js', 'public/js/admin_answers.js')
        .copy(paths.bootstrap + 'fonts/bootstrap/**', 'public/fonts/bootstrap')
        .copy(paths.font_awesome + 'fonts/**', 'public/fonts/')
        .styles(paths.font_awesome + 'css/font-awesome.css', 'public/css/font-awesome.css')
        .styles([
            'styles.css'
        ], 'public/css/styles.css');

});
