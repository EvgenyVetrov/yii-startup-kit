<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model modules\blog\models\backend\SearchBlogPosts */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="blog-posts-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'title') ?>

    <?= $form->field($model, 'bg_image') ?>

    <?= $form->field($model, 'general_image') ?>

    <?= $form->field($model, 'alt_image') ?>

    <?php // echo $form->field($model, 'announce') ?>

    <?php // echo $form->field($model, 'text') ?>

    <?php // echo $form->field($model, 'creation_date') ?>

    <?php // echo $form->field($model, 'publication_date') ?>

    <?php // echo $form->field($model, 'category') ?>

    <?php // echo $form->field($model, 'seo_keywords') ?>

    <?php // echo $form->field($model, 'seo_description') ?>

    <?php // echo $form->field($model, 'canonical_url') ?>

    <?php // echo $form->field($model, 'author_id') ?>

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
