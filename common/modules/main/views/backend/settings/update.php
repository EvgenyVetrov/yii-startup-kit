<?php

/* @var $this yii\web\View */
/* @var $model modules\main\models\backend\GeneralSettings */

$this->title = 'Update General Settings: ' . $model->name;

$this->params['pageTitle']     = 'Изменить настройку';
$this->params['breadcrumbs'][] = ['label' => 'Настройки', 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->name;

$this->params['content-fixed'] = true;
$this->params['pageIcon'] = 'cogs';
$this->params['place']    = 'general-settings';
?>
<div class="general-settings-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
