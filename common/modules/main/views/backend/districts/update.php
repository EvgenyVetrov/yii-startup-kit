<?php

/* @var $this yii\web\View */
/* @var $model modules\main\models\backend\Districts */

$this->title = 'Update Districts: ' . $model->name;

$this->params['pageTitle']     = 'Изменить область';
$this->params['breadcrumbs'][] = ['label' => 'Библиотека областей', 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->name;

$this->params['content-fixed'] = true; /* фиксируем ширину */
$this->params['place'] = 'districts';
?>
<div class="districts-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
