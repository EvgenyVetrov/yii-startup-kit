<?php

/* @var $this yii\web\View */
/* @var $model modules\main\models\TasksLogs */

$this->title = 'Create Tasks Logs';
$this->params['pageTitle']     = 'Добавить запись лога';
$this->params['breadcrumbs'][] = ['label' => 'Логи скриптов и задач', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Добавить запись лога';

$this->params['content-fixed'] = true;
$this->params['pageIcon'] = 'list-ul';
$this->params['place']    = 'tasks-logs';
?>
<div class="tasks-logs-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
