var elixir = require('laravel-elixir');
elixir.config.sourcemaps = false;

var gulp = require('gulp');

elixir(function (mix) {
    //combine css file
    mix.styles(
        //1.arrau with the file
        [
            //PLUGINS CSS STYLE
            'bootstrap.min.css',
            'font-awesome.min.css',
            'owl.carousel.min.css',
            'ie7.css',
            'meanmenu.css',
            'animate.css',
            'bundle.css',
            'style.css',
            'responsive.css'
        ],'public/css/all.css',//2.output file
        'resources/assets/css' //origin folder
    );
    mix.styles(
        //1.arrau with the file
        [
            //PLUGINS CSS STYLE
            'bootstrap.min.css',
            'now-ui-dashboard.css'
        ],'public/css/style.css',//2.output file
        'resources/assets/admin/css' //origin folder
    );

    //combine js file
    mix.scripts(
        [
            'js/jquery.js',
            'js/popper.js',
            'js/bootstrap.min.js',
            'js/owl.carousel.min.js',
            'js/jquery.meanmenu.js',
            'js/plugins.js',
            'js/main.js',
            'bower/vendor/axios/dist/axios.min.js'
        ], 'public/js/all.js',
        'resources/assets');

    mix.scripts(
        [
            'core/jquery.min.js',
            'core/popper.min.js',
            'core/bootstrap.min.js',
            'plugins/chartjs.min.js',
            'plugins/bootstrap-notify.js',
            'now-ui-dashboard.min.js'
        ], 'public/js/js.js',
        'resources/assets/admin/js');

})
