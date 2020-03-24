<?php

/* @var $this yii\web\View */
/* @var $model modules\users\models\backend\Profiles */

$this->title = 'Update Profiles: ' . $model->id;

$this->params['pageTitle']     = 'Изменить профиль';
$this->params['breadcrumbs'][] = ['label' => 'Профили', 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->id;

$this->params['pageIcon'] = 'user-o';
$this->params['place']    = 'profiles';
$this->params['content-fixed'] = true; /* фиксируем ширину */
?>
<div class="profiles-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
