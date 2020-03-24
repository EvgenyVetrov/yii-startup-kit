<?php

/* @var $this yii\web\View */
/* @var $model modules\blog\models\backend\BlogPosts */

$this->title = 'Create Blog Posts';
$this->params['pageTitle']     = 'Добавить статью';
$this->params['breadcrumbs'][] = ['label' => 'Статьи для блога', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Добавить статью';

$this->params['content-fixed'] = true;
$this->params['pageIcon'] = 'file-text-o';
$this->params['place']    = 'blog-posts';
?>
<div class="blog-posts-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
