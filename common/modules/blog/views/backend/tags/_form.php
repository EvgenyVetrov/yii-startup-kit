<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model modules\blog\models\backend\BlogTags */
?>


<?php $form = ActiveForm::begin(); ?>

<div class="box">
    <div class="box-body">
        <div class="row">
            <div class="col-md-3">
                <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-md-5">
                <?= $form->field($model, 'canonical_url')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-md-4">
                <?= $form->field($model, 'bg_image')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'seo_keywords')->textarea(['maxlength' => true]) ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'seo_description')->textarea(['maxlength' => true]) ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'own_description')->textarea(['maxlength' => true]) ?>
            </div>
        </div>
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'BTN_CREATE') : Yii::t('app', 'BTN_UPDATE'),
                ['class' => 'btn btn-primary']
            ) ?>
        </div>
    </div>
</div>

<?php ActiveForm::end(); ?>
