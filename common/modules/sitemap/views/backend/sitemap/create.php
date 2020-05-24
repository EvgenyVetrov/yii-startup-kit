<?php

/* @var $this yii\web\View */
/* @var $model modules\sitemap\models\backend\Sitemap */

$this->title = 'Create Sitemap';
$this->params['pageTitle']     = 'Добавить базовую запись в sitemap';
$this->params['breadcrumbs'][] = ['label' => 'Базовые записи sitemap', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Добавить базовую запись в sitemap';

$this->params['content-fixed'] = true;
$this->params['pageIcon'] = 'fas fa list-ul';
$this->params['place']    = 'sitemap';
?>
<div class="sitemap-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
