<?php

namespace themes\lte\assets;

use yii\web\AssetBundle;

/**
 * Class MainAsset
 */
class MainAsset extends AssetBundle{
    public $sourcePath = '@themes/lte/assets';
    public $css = [
        'plugins/select2/css/select2.min.css',
        //'plugins/tags/jquery.tagsinput.css',
        //'plugins/datetimepicker/bootstrap-datetimepicker.min.css',
        //'plugins/iCheck/minimal/blue.css',
        //'dist/css/skins/_all-skins.css',

        //'dist/css/main.css?v=16',


        'plugins/fontawesome-free/css/all.min.css',
        'plugins/fontawesome-free/webfonts/fa-regular-400.ttf',
        'plugins/fontawesome-free/webfonts/fa-regular-400.woff',
        'plugins/fontawesome-free/webfonts/fa-solid-900.ttf',
        'plugins/fontawesome-free/webfonts/fa-solid-900.woff',
        //'https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css',
        //'bootstrap/css/bootstrap-theme.css',
        'dist/css/adminlte.css',
        'dist/css/custom.css',
    ];
    public $js = [

        'dist/js/common.js',
        'plugins/select2/js/select2.full.js',
        'plugins/select2/js/i18n/ru.js',

        'plugins/moment/moment.min.js',
        'plugins/moment/locale/ru.js',

        //'plugins/datetimepicker/bootstrap-datetimepicker.min.js',
        //'plugins/datatable-responsive/datatable-responsive.js',
        'plugins/sweetalert2/sweetalert2.all.js',
        //'build/js/Toasts.js',
        //'build/js/Treeview.js',
        'plugins/bootstrap/js/bootstrap.bundle.js',
        'dist/js/adminlte.js',
        'dist/js/demo.js',
        //'plugins/ace-editor/ace.js',
        //'dist/js/app.js'
        //'dist/js/app.min.js?v=2.0.4'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        //'yii\bootstrap\BootstrapAsset',
        //'yii\bootstrap\BootstrapPluginAsset',
    ];
}
