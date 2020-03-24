<?php

/* @var $this yii\web\View */
/* @var $model modules\main\models\backend\GeneralSettings */

$this->title = 'Create General Settings';
$this->params['pageTitle']     = 'Создать настройку';
$this->params['breadcrumbs'][] = ['label' => 'Настройки', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Создать настройку';

$this->params['content-fixed'] = true;
$this->params['pageIcon'] = 'cogs';
$this->params['place']    = 'general-settings';
?>
<div class="general-settings-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
