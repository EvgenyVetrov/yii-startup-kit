<?php

use modules\users\models\backend\Users;

/* @var $this yii\web\View */
/* @var $model Users */

$this->title                     = 'Пользователи';
$this->params['pageTitle']       = 'Изменить пользователя';

$this->params['pageIcon']        = 'fas fa-user';
$this->params['place']           = 'users';
$this->params['breadcrumbs'][]   = ['label' => $this->title, 'url' => ['index']];
$this->params['breadcrumbs'][]   = $model->first_name;
?>

<div class="users-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
