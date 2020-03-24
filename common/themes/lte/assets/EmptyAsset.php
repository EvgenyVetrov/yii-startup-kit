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
        'plugins/fontawesome-free/css/fontawesome.min.css',        
        //'https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css',
        'dist/css/adminlte.min.css',
        //'dist/css/main.css?v=2.0.2',
    ];
    public $js = [];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];
}
