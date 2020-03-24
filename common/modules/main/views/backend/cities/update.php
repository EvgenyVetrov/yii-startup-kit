<?php

/* @var $this yii\web\View */
/* @var $model modules\main\models\backend\Cities */

$this->title = 'Update Cities: ' . $model->name;

$this->params['pageTitle']     = 'Изменить населенный пункт';
$this->params['breadcrumbs'][] = ['label' => 'Населенные пункты', 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->name;

$this->params['content-fixed'] = true; /* фиксируем ширину */
$this->params['place'] = 'cities';
?>
<div class="cities-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
