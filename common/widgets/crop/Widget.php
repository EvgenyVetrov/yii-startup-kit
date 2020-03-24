<?php

namespace common\widgets\crop;

use yii\web\JsExpression;
use yii\helpers\ArrayHelper;
use yii\widgets\InputWidget;
use common\widgets\crop\assets\Asset;
use common\behaviors\UploadImage;

class Widget extends InputWidget
{
    /**
     * Конфигурация JCrop
     * @var array
     */
    public $config = [];
    /**
     * Конфигурация JCrop по умолчанию
     * @var array
     */
    protected $configDefault = [
        'bgColor'    => '#ffffff',
        'bgOpacity'  => 0.5,
        'minSize'    => [100, 100],
        'keySupport' => false, // Important param to hide jCrop radio button.
        'setSelect'  => [20, 20, 200, 200],
        'boxWidth'   => 547,
    ];
    /**
     * @var bool
     */
    protected $crop = true;

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        Asset::register($this->getView());

        $this->configDefault['onSelect'] = new JsExpression('
            function (c) {
                setCoords("' . $this->attribute . '", c);
            }
        ');
        $this->config = ArrayHelper::merge($this->configDefault, $this->config);
    }

    /**
     * @inheritdoc
     */
    public function run()
    {
        return $this->render('upload', [
            'model'     => $this->model,
            'attribute' => $this->attribute,
            'config'    => $this->config,
            'crop'      => $this->crop,
            'widgetId'  => $this->id
        ]);
    }
}