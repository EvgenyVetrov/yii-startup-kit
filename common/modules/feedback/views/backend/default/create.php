<?php

/* @var $this yii\web\View */
/* @var $model modules\feedback\models\backend\Feedback */

$this->title = 'Create Feedback';
$this->params['pageTitle']     = 'Добавить обращение';
$this->params['breadcrumbs'][] = ['label' => 'Список обращений', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Добавить обращение';

$this->params['place']     = 'feedback';
$this->params['content-fixed'] = true; /* фиксируем ширину */
?>
<div class="feedback-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
