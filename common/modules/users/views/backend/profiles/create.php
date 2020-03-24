<?php

/* @var $this yii\web\View */
/* @var $model modules\users\models\backend\Profiles */

$this->title = 'Create Profiles';
$this->params['pageTitle']     = 'Добавить профиль';
$this->params['breadcrumbs'][] = ['label' => 'Профили', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Добавить профиль';

$this->params['pageIcon'] = 'user-o';
$this->params['place']    = 'profiles';
$this->params['content-fixed'] = true; /* фиксируем ширину */
?>
<div class="profiles-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
