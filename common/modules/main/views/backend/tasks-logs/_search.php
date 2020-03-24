<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model modules\main\models\backend\SearchTasksLogs */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tasks-logs-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'task') ?>

    <?= $form->field($model, 'processed_counter') ?>

    <?= $form->field($model, 'success_counter') ?>

    <?= $form->field($model, 'data') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'initiator') ?>

    <?php // echo $form->field($model, 'previous_log_offset') ?>

    <?php // echo $form->field($model, 'task_start_at') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
