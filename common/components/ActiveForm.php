<?php

namespace common\components;

use yii\helpers\Html;
use yii\helpers\Json;
use yii\widgets\ActiveField;
use yii\widgets\ActiveFormAsset;
use yii\base\InvalidCallException;

/**
 * Модифицированный ActiveForm с дополненным параметром отображения или не отображения тега <form> для того,
 * что бы часть формы можно было подгружать по AJAX
 *
 * Class ActiveForm
 * @package common\components
 */
class ActiveForm extends \yii\widgets\ActiveForm {
    /**
     * Не показывать тег <form>
     * @var bool
     */
    public $disabledTagForm = false;
    /**
     * @var ActiveField[]
     */
    private $_fields = [];

    /**
     * @inheritdoc
     */
    public function run()
    {
        if (!empty($this->_fields)) {
            throw new InvalidCallException('Each beginField() should have a matching endField() call.');
        }

        $content = ob_get_clean();

        if ($this->disabledTagForm === false){
            echo Html::beginForm($this->action, $this->method, $this->options);
        }

        echo $content;

        if ($this->enableClientScript) {
            $id = $this->options['id'];
            $options = Json::htmlEncode($this->getClientOptions());
            $attributes = Json::htmlEncode($this->attributes);
            $view = $this->getView();
            ActiveFormAsset::register($view);
            $view->registerJs("jQuery('#$id').yiiActiveForm($attributes, $options);");
        }

        if ($this->disabledTagForm === false){
            echo Html::endForm();
        }
    }
}