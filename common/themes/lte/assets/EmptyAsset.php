<?php

namespace themes\lte\assets;

use yii\web\AssetBundle;

/**
 * Class EmptyAsset
 */
class EmptyAsset extends AssetBundle
{
    public $sourcePath = '@themes/lte/assets';
    public $css = [
        //'https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css',
        'plugins/fontawesome-free/css/all.min.css',
        'plugins/fontawesome-free/webfonts/fa-regular-400.ttf',
        'plugins/fontawesome-free/webfonts/fa-regular-400.woff',
        'plugins/fontawesome-free/webfonts/fa-solid-900.ttf',
        'plugins/fontawesome-free/webfonts/fa-solid-900.woff',
        //'https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css',
        'dist/css/adminlte.css',
        'dist/css/custom.css',
    ];
    public $js = [];
    public $depends = [
        'yii\web\YiiAsset',
        //'yii\bootstrap\BootstrapAsset',
        //'yii\bootstrap\BootstrapPluginAsset',
    ];
}
