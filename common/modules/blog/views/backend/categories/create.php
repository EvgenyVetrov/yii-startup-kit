<?php

/* @var $this yii\web\View */
/* @var $model modules\blog\models\backend\BlogCategories */

$this->title = 'Create Blog Categories';
$this->params['pageTitle']     = 'Создание категории';
$this->params['breadcrumbs'][] = ['label' => 'Категории для блога', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Создание категории';

$this->params['content-fixed'] = true;
$this->params['pageIcon'] = 'sitemap';
$this->params['place']    = 'blog-categories';
?>
<div class="blog-categories-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
