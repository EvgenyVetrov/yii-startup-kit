<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this \yii\web\View */
/* @var $errorServers array */
/* @var $dataProvider \yii\data\ArrayDataProvider */

$this->title                     = 'Менеджер задач';
$this->params['pageTitle']       = $this->title;

$this->params['place']           = 'task-manager';
$this->params['pageIcon']        = 'tasks';
$this->params['breadcrumbs'][]   = $this->title;
?>

<?php foreach ($errorServers as $server => $error): ?>
    <div class="row">
        <div class="col-xs-12">
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-ban"></i> Сервер <?= $server ?></h4>
                <?= $error ?>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<div class="box">
    <div class="box-body no-padding">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                [
                    'label'     => 'Сервер',
                    'attribute' => 'server'
                ],
                [
                    'label'     => 'Функция',
                    'attribute' => 'function'
                ],
                [
                    'label'     => 'Очередь',
                    'attribute' => 'in_queue'
                ],
                [
                    'label'     => 'Выполняется',
                    'attribute' => 'jobs_running'
                ],
                [
                    'label'     => 'Воркеров',
                    'attribute' => 'capable_workers'
                ],
                [
                    'class'          => 'common\widgets\ActionColumn',
                    'firstButton'    => 'stop-worker',
                    'hiddenButtons'  => ['stop-task', 'stop-worker-empty'],
                    'headerOptions'  => [
                        //'data-hide' => 'xs,sm,md',
                        'data-name' => 'Действия'
                    ],
                    'urlCreator'     => function ($action, $model, $key, $index){
                        return [$action, 'id' => $model['function']];
                    },
                    'buttons' => [
                        'stop-worker' => function ($url, $model){
                            $name     = $model['function'];
                            $disabled = $model['capable_workers'] == 0;

                            return Html::a('<i class="fa fa-stop"></i> Остановить все воркеры', $url, [
                                'class'           => 'btn btn-primary btn-xs btn-flat',
                                'disabled'        => $disabled,
                                'data'            => [
                                    'pjax'        => 0,
                                    'method'      => 'post',
                                    'toggle'      => 'confirm',
                                    'title'       => 'Внимание',
                                    'description' => 'Вы уверены что хотите остановить все воркеры «' . $name . '»?'
                                ],
                            ]);
                        },
                        'stop-worker-empty' => function ($url, $model){
                            $name     = $model['function'];
                            $disabled = $model['capable_workers'] <= $model['in_queue'];

                            return Html::a('<i class="fa fa-stop"></i> Остановить воркеры в очереди', $url, [
                                'disabled'        => $disabled,
                                'data'            => [
                                    'pjax'        => 0,
                                    'method'      => 'post',
                                    'toggle'      => 'confirm',
                                    'title'       => 'Внимание',
                                    'description' => 'Вы уверены что хотите остановить воркеры «' . $name . '» которые находятся в очереди но не выполняются?'
                                ],
                            ]);
                        },
                        'stop-task' => function ($url, $model){
                            $name     = $model['function'];
                            $disabled = $model['in_queue'] == 0 || $model['in_queue'] == $model['jobs_running'];

                            return Html::a('<i class="fa fa-stop"></i> Остановить задачи в очереди', $url, [
                                'disabled'        => $disabled,
                                'data'            => [
                                    'pjax'        => 0,
                                    'method'      => 'post',
                                    'toggle'      => 'confirm',
                                    'title'       => 'Внимание',
                                    'description' => 'Вы уверены что хотите остановить все задачи «' . $name . '»?'
                                ],
                            ]);
                        },
                    ],
                ],
            ]
        ]) ?>
    </div>
</div>