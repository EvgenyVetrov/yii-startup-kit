<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model modules\users\models\backend\Profiles */
?>


<?php $form = ActiveForm::begin(); ?>

<div class="box">
    <div class="box-body">
        <div class="row">
            <div class="col-md-3">
                <?= $form->field($model, 'user_id')->textInput() ?>
            </div>
            <div class="col-md-3">
                <?= $form->field($model, 'org_id')->textInput() ?>
            </div>
            <div class="col-md-3">
                <?= $form->field($model, 'role')->textInput() ?>
            </div>
            <div class="col-md-3">
                <?= $form->field($model, 'status')->textInput() ?>
            </div>

        </div>
        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'custom_contacts')->textarea(['maxlength' => true, 'rows' => 4]) ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'json_contacts')->textarea(['rows' => 6]) ?>
            </div>

        </div>

        <div class="row">
            <div class="col-md-4">
                <?= $form->field($model, 'position')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-md-2">
                <?= $form->field($model, 'invite_status')->textInput() ?>
            </div>
            <div class="col-md-3">
                <?= $form->field($model, 'invite_date')->textInput() ?>
            </div>
            <div class="col-md-3">
                <?= $form->field($model, 'invite_user')->textInput() ?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'own_description')->textarea(['maxlength' => true, 'rows' => 4])  ?>
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
