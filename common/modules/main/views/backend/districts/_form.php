<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model modules\main\models\backend\Districts */
?>


<?php $form = ActiveForm::begin(); ?>

<div class="card card-outline card-primary">
    <div class="card-body">
        <div class="col-md-5">
            <div class="row">

                <?= $form->field($model, 'country_id')->textInput() ?>

                <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'status')->textInput() ?>

                <?= $form->field($model, 'sort')->textInput() ?>


                <div class="form-group">
                    <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'BTN_CREATE') : Yii::t('app', 'BTN_UPDATE'),
                        ['class' => 'btn btn-primary']
                    ) ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php ActiveForm::end(); ?>
