<?php

/* @var $this yii\web\View */
/* @var $model modules\site\models\backend\Pages */

$this->title = 'Update Pages: ' . $model->name;

$this->params['pageTitle']     = 'Изменить страницу';
$this->params['breadcrumbs'][] = ['label' => 'Страницы сайта', 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->name;

$this->params['content-fixed'] = true;
$this->params['pageIcon'] = 'fas fa-sitemap';
$this->params['place']    = 'site-pages';
$this->params['content-fixed'] = true;
?>
<div class="pages-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
