<?php

/* @var $this yii\web\View */
/* @var $model modules\blog\models\backend\BlogCategories */

$this->title = 'Update Blog Categories: ' . $model->name;

$this->params['pageTitle']     = 'Редактирование категории';
$this->params['breadcrumbs'][] = ['label' => 'Категории для блога', 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->name;

$this->params['content-fixed'] = true;
$this->params['pageIcon'] = 'sitemap';
$this->params['place']    = 'blog-categories';
?>
<div class="blog-categories-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
