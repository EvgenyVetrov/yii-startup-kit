<?php

use yii\helpers\Html;
use yii\helpers\Json;
use yii\bootstrap\Modal;
use yii\bootstrap\Button;
use yii\web\JsExpression;

/* @var $this yii\web\View */
/* @var $model \yii\db\ActiveRecord */
/* @var $attribute string */
/* @var $config array */
/* @var $crop bool */

$jsExpression = new JsExpression("readFile('" . $attribute . "', " . Json::encode($config) . ")");
$js = <<<JS
function uploadFileProcessor_$widgetId(){
    $jsExpression
}
JS;
$this->registerJs($js, $this::POS_END);
?>

<?= Html::activeFileInput($model, $attribute, [
    'id'       => $attribute . '-crop',
    'class' => 'btn btn-default',
    'onchange' => $crop ? 'uploadFileProcessor_'. $widgetId .'()' : null,
]) ?>
<?php if ($crop): ?>

    <?= Html::hiddenInput("crop[$attribute][x]", null, ['id' => "$attribute-crop-x"]) ?>
    <?= Html::hiddenInput("crop[$attribute][w]", null, ['id' => "$attribute-crop-w"]) ?>
    <?= Html::hiddenInput("crop[$attribute][y]", null, ['id' => "$attribute-crop-y"]) ?>
    <?= Html::hiddenInput("crop[$attribute][h]", null, ['id' => "$attribute-crop-h"]) ?>

    <?php Modal::begin([
        'id' => $attribute . '-crop-modal',
        'header' => '<h2>Обрезка изображения</h2>',
        'closeButton' => [
            'onclick' => 'destroyJcrop("' . $attribute . '-crop-image");',
            'id' => $attribute . '-crop-close'
        ],
        'footer' => Button::widget([
            'label' => 'Сохранить',
            'options' => [
                'class' => 'btn btn-flat btn-primary',
                'onclick' => '$("#' . $attribute . '-crop-close").click(); return false;'
            ],
        ]),
    ]); ?>

    <div class="thumbnail">
        <img src="" alt="" id="<?= $attribute ?>-crop-image">
    </div>

    <?php Modal::end() ?>

<?php endif;

//$js = <<<
