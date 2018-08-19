var elixir = require('laravel-elixir');
elixir.config.sourcemaps = false;

var gulp = require('gulp');

elixir(function (mix) {
    //combine css file
    mix.styles(
        //1.arrau with the file
        [
            //PLUGINS CSS STYLE
            'plugins/jquery-ui/jquery-ui.css',
            'plugins/bootstrap/css/bootstrap.min.css',
            'plugins/font-awesome/css/font-awesome.min.css',
            'plugins/selectbox/select_option1.css',
            'plugins/fancybox/jquery.fancybox.min.css',
            'plugins/iziToast/css/iziToast.css',
            'plugins/prismjs/prism.css',
            'plugins/rs-plugin/css/settings.css',
            'plugins/slick/slick.css',
            'plugins/slick/slick-theme.css',
            //CUSTOM CSS -->
            'css/style.css',
            'css/color-option4.css'
        ],'public/css/all.css',//2.output file
        'resources/assets' //origin folder
    );
    mix.styles(
        //1.arrau with the file
        [
            //PLUGINS CSS STYLE
            'bootstrap.min.css',
            'now-ui-dashboard.css'
        ],'public/css/style.css',//2.output file
        'resources/assets/Admin/css' //origin folder
    );

    //combine js file
    mix.scripts(
        [
            'plugins/jquery/jquery.min.js',
            'plugins/jquery/jquery-migrate-3.0.0.min.js',
            'plugins/jquery-ui/jquery-ui.js',
            'plugins/bootstrap/js/popper.min.js',
            'plugins/bootstrap/js/bootstrap.min.js',
            'plugins/rs-plugin/js/jquery.themepunch.tools.min.js',
            'plugins/rs-plugin/js/jquery.themepunch.revolution.min.js',
            'plugins/slick/slick.js',
            'plugins/fancybox/jquery.fancybox.min.js',
            'plugins/iziToast/js/iziToast.js',
            'plugins/prismjs/prism.js',
            'plugins/selectbox/jquery.selectbox-0.1.3.min.js',
            'plugins/countdown/jquery.syotimer.js',
            'plugins/velocity/velocity.min.js',
            'js/custom.js'
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
        'resources/assets/Admin/js');

})
