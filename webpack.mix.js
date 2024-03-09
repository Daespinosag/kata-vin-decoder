const mix = require('laravel-mix');

/*
 | Mix Asset Management
 */
mix.js('resources/js/app.js', 'public/js')
    .vue({ version: 2 })
    .postCss('resources/css/app.css', 'public/css', [
        require('postcss-import'),
        require('tailwindcss'),
        require('autoprefixer'),
    ]);


