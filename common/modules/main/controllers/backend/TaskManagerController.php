<?php

namespace modules\main\controllers\backend;

use yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\data\ArrayDataProvider;
use modules\main\models\backend\TaskManager;

/**
 * Class TaskManagerController
 * @package modules\main\controllers\backend
 */
class TaskManagerController extends Controller{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'stop-worker' => ['POST'],
                    'stop-task'   => ['POST'],
                ],
            ],
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow'   => true,
                        'roles'   => ['task-manager'],
                    ],
                ],
            ]
        ];
    }

    /**
     * @return string
     */
    public function actionIndex()
    {
        $model = new TaskManager();

        $dataProvider = new ArrayDataProvider([
            'allModels' => $model->status()
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'errorServers' => $model->errorServers
        ]);
    }

    /**
     * @param $id
     * @return yii\web\Response
     */
    public function actionStopWorker($id)
    {
        $model = new TaskManager();
        $model->stopWorker($id);

        return $this->redirect(['index']);
    }

    /**
     * @param $id
     * @return yii\web\Response
     */
    public function actionStopWorkerEmpty($id)
    {
        $model = new TaskManager();
        $model->stopWorkerEmpty($id);

        return $this->redirect(['index']);
    }

    /**
     * @param $id
     * @return yii\web\Response
     */
    public function actionStopTask($id)
    {
        $model = new TaskManager();
        $model->stopTask($id);

        return $this->redirect(['index']);
    }
}