const elixir = require('laravel-elixir');

require('laravel-elixir-vue');

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

elixir(mix => {
    mix
        .copy('./resources/assets/fonts', 'public/build/fonts')
        .copy('./resources/assets/images', 'public/images')
        .copy('./resources/assets/avatars', 'public/avatars')
        .copy('./resources/assets/files', 'public/files')
        .copy('./resources/assets/pdfs', 'public/pdfs')
        .less(
            'app.less'
        )
        .styles([
            'style.css',
            'dropzone.css',
            'angular-toastr.css',
            'ui-select.css',
            'datepicker.css',
            'thailand.css',
            'AdminLTE.css',
            '_all-skin.css',
            'font-awesome.css'
        ])
        .scripts([
             "libs/jquery.js",
            'libs/**/*.js',
            'AdminLTE.js',
            'app.js',
            'controllers/**/*.js',
            'services/**/*.js',
            'directives/**/*.js'
        ])
        .version([
            'css/all.css',
            'css/app.css',
            'js/all.js'
        ]);
});
