<?php

/* @var $this yii\web\View */
/* @var $model modules\blog\models\backend\BlogPosts */

$this->title = 'Update Blog Posts: ' . $model->title;

$this->params['pageTitle']     = 'Редактирование статьи';
$this->params['breadcrumbs'][] = ['label' => 'Статьи для блога', 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->title;

$this->params['content-fixed'] = true;
$this->params['pageIcon'] = 'file-text-o';
$this->params['place']    = 'blog-posts';
?>
<div class="blog-posts-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
