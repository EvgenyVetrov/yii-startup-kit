<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model modules\site\models\backend\SearchPages */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pages-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'location') ?>

    <?= $form->field($model, 'content') ?>

    <?= $form->field($model, 'js') ?>

    <?php // echo $form->field($model, 'custom_head') ?>

    <?php // echo $form->field($model, 'robots') ?>

    <?php // echo $form->field($model, 'keywords') ?>

    <?php // echo $form->field($model, 'description') ?>

    <?php // echo $form->field($model, 'title') ?>

    <?php // echo $form->field($model, 'blocks_ids') ?>

    <?php // echo $form->field($model, 'sitemap_lastmod') ?>

    <?php // echo $form->field($model, 'sitemap_changefreq') ?>

    <?php // echo $form->field($model, 'sitemap_priority') ?>

    <?php // echo $form->field($model, 'type') ?>

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
