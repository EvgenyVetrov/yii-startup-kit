<?php

namespace themes\kit\assets;

use yii\web\AssetBundle;

/**
 * Class EmptyAsset
 */
class EmptyAsset extends AssetBundle
{
    public $sourcePath = '@themes/material/assets';
    public $css = [
        'css/bootstrap.min.css',
        'css/material-dashboard.css@v=1.2.0.css',
        'css/demo.css',
        'http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css',
        //'https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons',
        //'https://fonts.googleapis.com/icon?family=Material+Icons',

    ];
    public $js = [

        //'js/jquery-3.2.1.min.js',
        'js/bootstrap.min.js',
        'js/material.min.js',
        'js/perfect-scrollbar.jquery.min.js',
        'js/arrive.min.js',
        //'js/jquery.validate.min.js',
        'js/es6-promise-auto.min.js',
        'js/moment.min.js',
        'js/chartist.min.js',
        'js/jquery.bootstrap-wizard.js',
        'js/bootstrap-notify.js',
        'js/jquery.sharrre.js',
        'js/bootstrap-datetimepicker.js',
        'js/jquery-jvectormap.js',
        'js/nouislider.min.js',
        'js/jquery.select-bootstrap.js',
        'js/jquery.datatables.js',
        'js/sweetalert2.js',
        'js/jasny-bootstrap.min.js',
        'js/fullcalendar.min.js',
        'js/jquery.tagsinput.js',
        'js/material-dashboard.js@v=1.2.0',
        'js/demo.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];
}