<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model modules\feedback\models\backend\FeedbackSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="feedback-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'user_id') ?>

    <?= $form->field($model, 'email') ?>

    <?= $form->field($model, 'org_id') ?>

    <?= $form->field($model, 'type') ?>

    <?php // echo $form->field($model, 'object') ?>

    <?php // echo $form->field($model, 'object_id') ?>

    <?php // echo $form->field($model, 'text') ?>

    <?php // echo $form->field($model, 'ip') ?>

    <?php // echo $form->field($model, 'user_agent') ?>

    <?php // echo $form->field($model, 'device_info') ?>

    <?php // echo $form->field($model, 'own_description') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
