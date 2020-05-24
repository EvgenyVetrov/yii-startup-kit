<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model modules\feedback\models\backend\Feedback */
?>


<?php $form = ActiveForm::begin(); ?>

<div class="card card-outline card-primary">
    <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <?= $form->field($model, 'user_id')->textInput() ?>
                </div>
                <div class="col-md-6">
                    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-6">
                    <?= $form->field($model, 'org_id')->textInput() ?>
                </div>
                <div class="col-md-6">
                    <?= $form->field($model, 'type')->textInput() ?>
                </div>
                <div class="col-md-6">
                    <?= $form->field($model, 'object')->textInput() ?>
                </div>
                <div class="col-md-6">
                    <?= $form->field($model, 'object_id')->textInput() ?>
                </div>
                <div class="col-md-6">
                    <?= $form->field($model, 'text')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-6">
                    <?= $form->field($model, 'ip')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-6">
                    <?= $form->field($model, 'user_agent')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-6">
                    <?= $form->field($model, 'device_info')->textarea(['rows' => 6]) ?>
                </div>
                <div class="col-md-6">
                    <?= $form->field($model, 'own_description')->textarea(['maxlength' => true, 'rows' => 6]) ?>
                </div>
                <div class="col-md-6">
                    <?= $form->field($model, 'status')->textInput() ?>
                </div>
























            </div>
            <div class="row">
                <div class="col-md-12">
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
