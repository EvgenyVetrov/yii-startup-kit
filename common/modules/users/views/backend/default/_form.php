<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use modules\users\models\backend\Users;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model Users */

$this->registerJs('
    $("#users-ban_exists").on("change", function (){
        if ($(this).prop("checked") == true){
            $("#show-ban-description").show();
        }else{
            $("#show-ban-description").hide();
        }
    });
');
?>

<?php $form = ActiveForm::begin(); ?>

<div class="card card-outline card-primary">
    <div class="card-body">

            <div class="row">
                <div class="col-md-6">
                    <?= $form->field($model, 'first_name') ?>
                </div>
                <div class="col-md-6">
                    <?= $form->field($model, 'email') ?>
                </div>
                <div class="col-md-6">
                    <?= $form->field($model, 'password_new')->passwordInput() ?>
                </div>
                <div class="col-md-6">
                    <?= $form->field($model, 'password_repeat')->passwordInput() ?>
                </div>






                <?php if ($model->scenario == Users::SCENARIO_UPDATE): ?>
                <div class="col-md-6">
                    <?= $form->field($model, 'ban_exists')->checkbox() ?>

                    <div id="show-ban-description" style="display: <?= $model->ban_exists == 1 ? 'block' : 'none' ?>">
                        <?= $form->field($model, 'ban_description')->textarea() ?>
                    </div>
                </div>
                <?php endif; ?>
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