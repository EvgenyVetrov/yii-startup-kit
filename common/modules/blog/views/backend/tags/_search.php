<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model modules\blog\models\backend\SearchBlogTags */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="blog-tags-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'canonical_url') ?>

    <?= $form->field($model, 'seo_keywords') ?>

    <?= $form->field($model, 'seo_description') ?>

    <?php // echo $form->field($model, 'bg_image') ?>

    <?php // echo $form->field($model, 'own_description') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
