<?php

namespace modules\main\controllers\backend;

use Yii;
use modules\main\models\backend\GeneralSettings;
use modules\main\models\backend\SearchGeneralSettings;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SettingsController implements the CRUD actions for GeneralSettings model.
 */
class SettingsController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }



    /**
     * Lists all GeneralSettings models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SearchGeneralSettings();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }



    /**
     * Список всех настроек для конкретного модуля
     * @return mixed
     */
    public function actionModule($module_name)
    {
        $searchModel = new SearchGeneralSettings();
        $queryParams = Yii::$app->request->queryParams;
        $queryParams['SearchGeneralSettings']['module'] = $module_name;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('module-index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'module_name' => $module_name
        ]);
    }



    /**
     * Displays a single GeneralSettings model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new GeneralSettings model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new GeneralSettings();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Запись успешно добавлена!');
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing GeneralSettings model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Данные успешно изменены!');
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing GeneralSettings model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        Yii::$app->session->setFlash('success', 'Запись успешно удалена!');

        return $this->redirect(['index']);
    }

    /**
     * Finds the GeneralSettings model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return GeneralSettings the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = GeneralSettings::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException(Yii::t('app', 'ERROR_404'));
        }
    }
}
