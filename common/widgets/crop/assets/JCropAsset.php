<?php

namespace common\widgets\crop\assets;

use yii\web\AssetBundle;

class JCropAsset extends AssetBundle
{
    /**
     * @inheritdoc
     */
    public $sourcePath = '@common/widgets/crop/assets';
    /**
     * @inheritdoc
     */
    public $css = [
        'css/jquery.jcrop.min.css',
    ];
    /**
     * @inheritdoc
     */
    public $js = [
        'js/jquery.jcrop.min.js',
    ];
}