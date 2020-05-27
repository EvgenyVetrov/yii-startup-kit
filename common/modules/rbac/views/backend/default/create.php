<?php

/* @var $this yii\web\View */
/* @var $model \modules\rbac\models\PermissionsForm */

$this->title = 'Права доступа';
$this->params['pageTitle'] = $this->title;
$this->params['pageIcon'] = 'unlock-alt';
$this->params['place'] = 'rbac';
$this->params['breadcrumbs'][] = ['label' => 'Права доступа', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Добавить';
?>

<div class="rbac-create">
    <?= $this->render('_form', [
        'model' => $model
    ]) ?>
</div>