<?php

namespace common\widgets\crop\assets;

use yii\web\AssetBundle;

class Asset extends AssetBundle
{
    /**
     * @inheritdoc
     */
    public $sourcePath = '@common/widgets/crop/assets';
    /**
     * @inheritdoc
     */
    public $js = [
        'js/crop.js',
    ];
    /**
     * @inheritdoc
     */
    public $depends = [
        'yii\web\JqueryAsset',
        'common\widgets\crop\assets\JCropAsset'
    ];
}