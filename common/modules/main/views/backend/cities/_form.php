<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model modules\main\models\backend\Cities */
?>


<?php $form = ActiveForm::begin(); ?>

<div class="box">
    <div class="box-body">
        <div class="row">

            <div class="col-md-3">
                <?= $form->field($model, 'form')->textInput() ?>
            </div>
            <div class="col-md-5">
                <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-md-4">
                <?= $form->field($model, 'district_id')->dropDownList([
                        $model->district_id => $model->getDistrictName()
                ], [
                    'class' => 'select2-ajax',
                    'style' => 'width: 100%',
                    'data'  => [
                        'ajax--url' => \yii\helpers\Url::to('search-district-for-select?district_id='.$model->id)
                    ]
                ]) ?>
            </div>
            <div class="col-md-3">
                <?= $form->field($model, 'population')->textInput() ?>
            </div>

            <div class="col-md-5">
                <?= $form->field($model, 'area')->textInput() ?>
            </div>


            <div class="col-md-2">
                <?= $form->field($model, 'sort')->textInput() ?>
            </div>
            <div class="col-md-2">
                <?php // $form->field($model, 'status')->textInput() ?>
                <?= $form->field($model, 'status')->dropDownList(\modules\main\models\BaseCities::statuses(), [
                    'class'  => 'form-control select2',
                    'style'  => 'width: 100%;',
                ]) ?>
            </div>

            <div class="col-md-6">
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
