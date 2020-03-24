<?php

/* @var $this yii\web\View */
/* @var $model modules\main\models\TasksLogs */

$this->title = 'Update Tasks Logs: ' . $model->id;

$this->params['pageTitle']     = 'Изменить запись лога';
$this->params['breadcrumbs'][] = ['label' => 'Логи скриптов и задач', 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->id;

$this->params['content-fixed'] = true;
$this->params['pageIcon'] = 'list-ul';
$this->params['place']    = 'tasks-logs';
?>
<div class="tasks-logs-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
