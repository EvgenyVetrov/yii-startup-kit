<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model modules\main\models\TasksLogs */
?>


<?php $form = ActiveForm::begin(); ?>

<div class="box">
    <div class="box-body">
        <div class="col-md-5">
            <div class="row">

                <?= $form->field($model, 'task')->textInput() ?>

                <?= $form->field($model, 'processed_counter')->textInput() ?>

                <?= $form->field($model, 'success_counter')->textInput() ?>

                <?= $form->field($model, 'data')->textarea(['rows' => 6]) ?>

                <?= $form->field($model, 'status')->textInput() ?>

                <?= $form->field($model, 'initiator')->textInput() ?>

                <?= $form->field($model, 'previous_log_offset')->textInput() ?>

                <?= $form->field($model, 'task_start_at')->textInput() ?>

                <?= $form->field($model, 'created_at')->textInput() ?>


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
