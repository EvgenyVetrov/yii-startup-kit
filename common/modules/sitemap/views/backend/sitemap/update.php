<?php

/* @var $this yii\web\View */
/* @var $model modules\sitemap\models\backend\Sitemap */

$this->title = 'Update Sitemap: ' . $model->name;

$this->params['pageTitle']     = 'Изменить базовую запись в sitemap';
$this->params['breadcrumbs'][] = ['label' => 'Базовые записи sitemap', 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->name;

$this->params['content-fixed'] = true;
$this->params['pageIcon'] = 'list-ul';
$this->params['place']    = 'sitemap';
?>
<div class="sitemap-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
