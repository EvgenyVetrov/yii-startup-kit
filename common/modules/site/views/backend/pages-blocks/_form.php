<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model modules\site\models\backend\PagesBlocks */
?>


<?php $form = ActiveForm::begin(); ?>

<div class="card card-primary card-outline">
    <div class="card-body">

            <div class="row">

                <div class="col-md-6">                <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-6">                <?= $form->field($model, 'alias')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-6">                <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>
                </div>
                <div class="col-md-6">                <?= $form->field($model, 'own_description')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-6">                <?= $form->field($model, 'status')->textInput() ?>
                </div>
                <div class="col-md-6">                <?= $form->field($model, 'created_at')->textInput() ?>
                </div>
                <div class="col-md-6">                <?= $form->field($model, 'updated_at')->textInput() ?>
                </div>
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
