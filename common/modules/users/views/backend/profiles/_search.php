<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model modules\users\models\backend\SearchProfiles */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="profiles-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'user_id') ?>

    <?= $form->field($model, 'org_id') ?>

    <?= $form->field($model, 'json_contacts') ?>

    <?= $form->field($model, 'custom_contacts') ?>

    <?php // echo $form->field($model, 'role') ?>

    <?php // echo $form->field($model, 'position') ?>

    <?php // echo $form->field($model, 'invite_status') ?>

    <?php // echo $form->field($model, 'invite_date') ?>

    <?php // echo $form->field($model, 'invite_user') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'own_description') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
