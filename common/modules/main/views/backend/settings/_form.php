<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use modules\main\models\backend\GeneralSettings;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model modules\main\models\backend\GeneralSettings */


?>


<?php $form = ActiveForm::begin(); ?>

<div class="box">
    <div class="box-body">
            <div class="row">
                <div class="col-md-6">
                    <?= $form->field($model, 'alias')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-6">
                    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-4">
                    <?= $form->field($model, 'module')
                        ->dropDownList( [0 => 'без модуля'] + GeneralSettings::getModulesList() ,
                            [
                                'class'  => 'form-control select2',
                                'style'  => 'width: 100%;',
                            ]) ?>
                </div>

                <div class="col-md-4">
                    <?= $form->field($model, 'type')
                        ->dropDownList( $model->typeLabels() ,
                            [
                                'class'  => 'form-control select2',
                                'style'  => 'width: 100%;',
                            ]) ?>
                </div>
                <div class="col-md-4">
                    <?= $form->field($model, 'status')
                        ->dropDownList( $model->statusLabels() ,
                            [
                                'class'  => 'form-control select2',
                                'style'  => 'width: 100%;',
                            ]) ?>
                </div>
                <div class="col-md-6">
                    <?= $form->field($model, 'value')->textarea(['maxlength' => true]) ?>
                </div>
                <div class="col-md-6">
                    <?= $form->field($model, 'description')->textarea(['maxlength' => true]) ?>
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
