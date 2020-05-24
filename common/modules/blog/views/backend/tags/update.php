<?php

/* @var $this yii\web\View */
/* @var $model modules\blog\models\backend\BlogTags */

$this->title = 'Update Blog Tags: ' . $model->name;

$this->params['pageTitle']     = 'Редактирование тега';
$this->params['breadcrumbs'][] = ['label' => 'Теги для блога', 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->name;

$this->params['content-fixed'] = true;
$this->params['pageIcon'] = 'fas fa-tags';
$this->params['place']    = 'blog-tags';
?>
<div class="blog-tags-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
