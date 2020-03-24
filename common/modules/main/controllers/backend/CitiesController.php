<?php

namespace modules\main\controllers\backend;

use modules\main\models\backend\Districts;
use Yii;
use modules\main\models\backend\Cities;
use modules\main\models\backend\SearchCities;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CitiesController implements the CRUD actions for Cities model.
 */
class CitiesController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Cities models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SearchCities();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'countActiveCities' => Cities::countActiveCities(),
            'searchModel'       => $searchModel,
            'dataProvider'      => $dataProvider,
        ]);
    }

    /**
     * Displays a single Cities model.
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
     * Creates a new Cities model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Cities();

        if (!Yii::$app->request->post()) { $model->sort = 1; } // если эо первичное открытие страницы,то для удбства sort автозаполняем 1

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
     * Updates an existing Cities model.
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
     * Deletes an existing Cities model.
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
     * Метод для возврата результатов для автокомплита в select2 - поиск по областям
     * Запрашивается по ajax
     *
     * @param $district_id
     * @return string
     */
    public function actionSearchDistrictForSelect($district_id)
    {
        $query = Yii::$app->request->post('query');
        $model = Districts::find()
            ->where(['status' => 1])
            ->andWhere(['!=', 'id', $district_id])
            ->andWhere(['like', 'name', $query])
            ->all();

        $results = [];
        foreach ($model as $item){
            $results[] = [
                'id'   => $item->id,
                'text' => $item->name //. ' ['. $item->id . ']'
            ];

        }

        $results = [ 'items' => $results, 'status' => 'ok' ]; // именно такой формат нужен для select2!!!
        return json_encode($results);
    }


    /**
     * Finds the Cities model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Cities the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Cities::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException(Yii::t('app', 'ERROR_404'));
        }
    }
}
