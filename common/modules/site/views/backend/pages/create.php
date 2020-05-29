<?php

/* @var $this yii\web\View */
/* @var $model modules\site\models\backend\Pages */

$this->title = 'Create Pages';
$this->params['pageTitle']     = 'Добавить страницу';
$this->params['breadcrumbs'][] = ['label' => 'Страницы сайта', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Добавить страницу';

$this->params['content-fixed'] = true;
$this->params['pageIcon'] = 'fas fa-sitemap';
$this->params['place']    = 'site-pages';
?>
<div class="pages-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
