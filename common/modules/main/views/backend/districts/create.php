<?php

/* @var $this yii\web\View */
/* @var $model modules\main\models\backend\Districts */

$this->title = 'Create Districts';
$this->params['pageTitle']     = 'Добавить область';
$this->params['breadcrumbs'][] = ['label' => 'Библиотека областей', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Добавить область';

$this->params['content-fixed'] = true; /* фиксируем ширину */
$this->params['place'] = 'districts';
?>
<div class="districts-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
