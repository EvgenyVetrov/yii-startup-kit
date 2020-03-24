<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model modules\sitemap\models\backend\Sitemap */
?>


<?php $form = ActiveForm::begin(); ?>

<div class="box">
    <div class="box-body">
        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'lastmod')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'loc')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'changefreq')->textInput() ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'priority')->textInput() ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'own_description')->textarea(['maxlength' => true, 'rows' => 3]) ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'status')->dropDownList($model::statusLabels(), [
                    'class'  => 'form-control select2',
                    'style'  => 'width: 100%;',
                ]) ?>
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
