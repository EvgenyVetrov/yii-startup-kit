<?php

namespace themes\kit\assets;

use yii\web\AssetBundle;

/**
 * Class MainAsset
 */
class MainAsset extends AssetBundle {

    public $sourcePath = '@themes/kit/assets';
    public $css = [
        'css/material-kit.min.css',
        'css/fonts.css',
        'css/fontawersome.css',
        'css/custom.css',
        /*'css/click-effects.css',
        'css/fontawersome.css',
        'https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons',
        'https://fonts.googleapis.com/icon?family=Material+Icons',*/

    ];
    public $js = [

        'js/core/popper.min.js',
        'js/core/bootstrap-material-design.min.js',
        'js/plugins/moment.min.js',
        'js/plugins/bootstrap-datetimepicker.js',
        'js/plugins/nouislider.min.js',
        'js/plugins/bootstrap-select.min.js',
        'js/plugins/sweetalert2.all.min.js',

        'js/material-kit.min.js',
        'js/common.js',

    ];
    public $depends = [
        'yii\web\YiiAsset',
        //'yii\bootstrap\BootstrapAsset', // подключает bootstrap3, а это мешает отображаться bootstrap4
        //'yii\bootstrap\BootstrapPluginAsset',
    ];
}
