<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $generator \common\gii\lte\crud\Generator */

/* @var $model \yii\db\ActiveRecord */
$model = new $generator->modelClass();
$safeAttributes = $model->safeAttributes();
if (empty($safeAttributes)) {
    $safeAttributes = $model->attributes();
}

echo "<?php\n";
?>

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model <?= ltrim($generator->modelClass, '\\') ?> */
?>


<?= "<?php " ?>$form = ActiveForm::begin(); ?>

<div class="card card-primary card-outline">
    <div class="card-body">

            <div class="row">

<?php foreach ($generator->getColumnNames() as $attribute) {
    if (in_array($attribute, $safeAttributes)) {
        echo "                <div class=\"col-md-6\">                <?= " . $generator->generateActiveField($attribute) . " ?>\n                </div>\n";
    }
} ?>
                <div class="col-md-12">
                    <div class="form-group">
                        <?= '<?= Html::submitButton($model->isNewRecord ? Yii::t(\'app\', \'BTN_CREATE\') : Yii::t(\'app\', \'BTN_UPDATE\'),
                        [\'class\' => \'btn btn-primary\']
                    ) ?>' ?>

                    </div>
                </div>
            </div>
    </div>
</div>

<?= "<?php " ?>ActiveForm::end(); ?>
