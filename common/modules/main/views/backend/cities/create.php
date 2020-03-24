<?php

/* @var $this yii\web\View */
/* @var $model modules\main\models\backend\Cities */

$this->title = 'Create Cities';
$this->params['pageTitle']     = 'Создать населенный пункт';
$this->params['breadcrumbs'][] = ['label' => 'Населенные пункты', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Создать населенный пункт';
$this->params['content-fixed'] = true; /* фиксируем ширину */
$this->params['place'] = 'cities';
?>
<div class="cities-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
