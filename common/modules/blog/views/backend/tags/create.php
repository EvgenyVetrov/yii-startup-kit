<?php

/* @var $this yii\web\View */
/* @var $model modules\blog\models\backend\BlogTags */

$this->title = 'Create Blog Tags';
$this->params['pageTitle']     = 'Создание тега';
$this->params['breadcrumbs'][] = ['label' => 'Теги для блога', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Создание тега';

$this->params['content-fixed'] = true;
$this->params['pageIcon'] = 'tags';
$this->params['place']    = 'blog-tags';
?>
<div class="blog-tags-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
