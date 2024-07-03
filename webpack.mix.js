const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js')
   .sass('resources/sass/app.scss', 'public/css')
   .copy('node_modules/moment/moment.js', 'public/js/moment.js')
   .copy('node_modules/moment-timezone/moment-timezone.js', 'public/js/moment-timezone.js');

   mix.js('resources/js/app.js', 'public/js')
   .sass('resources/sass/app.scss', 'public/css')
   .minify('public/js/app.js')
   .minify('public/css/app.css');
