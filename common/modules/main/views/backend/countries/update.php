<?php

/* @var $this yii\web\View */
/* @var $model modules\main\models\backend\Countries */

$this->title = 'Update Countries: ' . $model->name;

$this->params['pageTitle']     = 'Изменить страну';
$this->params['breadcrumbs'][] = ['label' => 'Библиотека стран', 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->name;

$this->params['content-fixed'] = true; /* фиксируем ширину */
$this->params['place'] = 'countries';
?>
<div class="countries-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
