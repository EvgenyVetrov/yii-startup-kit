<?php

/* @var $this yii\web\View */
/* @var $model modules\main\models\backend\Countries */

$this->title = 'Create Countries';
$this->params['pageTitle']     = 'Добавить страну';
$this->params['breadcrumbs'][] = ['label' => 'Библиотека стран', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Добавить страну';

$this->params['content-fixed'] = true; /* фиксируем ширину */
$this->params['place'] = 'countries';
?>
<div class="countries-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
