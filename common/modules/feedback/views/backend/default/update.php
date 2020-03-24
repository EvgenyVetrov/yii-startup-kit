<?php

/* @var $this yii\web\View */
/* @var $model modules\feedback\models\backend\Feedback */

$this->title = 'Update Feedback: ' . $model->id;

$this->params['pageTitle']     = 'Изменить обращение';
$this->params['breadcrumbs'][] = ['label' => 'Список обращений', 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->id;

$this->params['place']     = 'feedback';
$this->params['content-fixed'] = true; /* фиксируем ширину */
?>
<div class="feedback-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
