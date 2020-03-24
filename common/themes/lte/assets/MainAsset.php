<?php

namespace themes\lte\assets;

use yii\web\AssetBundle;

/**
 * Class MainAsset
 */
class MainAsset extends AssetBundle{
    public $sourcePath = '@themes/lte/assets';
    public $css = [
        'https://fonts.googleapis.com/css?family=Kurale|Roboto|Roboto+Condensed|Open+Sans',
        'plugins/fontawesome-free/css/fontawesome.min.css',
        //'https://fonts.googleapis.com/icon?family=Material+Icons',
        'plugins/select2/select2.min.css',
        'dist/css/adminlte.css',
        'plugins/tags/jquery.tagsinput.css',
        'plugins/datetimepicker/bootstrap-datetimepicker.min.css',
        'plugins/iCheck/minimal/blue.css',
        'dist/css/skins/_all-skins.css',
        //'dist/css/main.css?v=16',
        'dist/css/main.css',
    ];
    public $js = [
        'plugins/select2/select2.full.js',
        'plugins/select2/i18n/ru.js',
        'plugins/slimScroll/jquery.slimscroll.min.js',
        'plugins/fastclick/fastclick.min.js',
        'plugins/tags/jquery.tagsinput.js',
        'plugins/moment/moment.js',
        'plugins/moment/locales/ru.js',
        'plugins/datetimepicker/bootstrap-datetimepicker.min.js',
        'plugins/datatable-responsive/datatable-responsive.js',
        'plugins/clipboard/clipboard.min.js',
        'plugins/autoresize/autoresize.js',
        'plugins/iCheck/icheck.min.js',
        'plugins/sweetalert2/sweetalert2.all.js',
        //'plugins/ace-editor/ace.js',
        'dist/js/app.js'
        //'dist/js/app.min.js?v=2.0.4'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];
}
