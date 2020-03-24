<?php

namespace modules\sitemap\controllers\backend;

use Yii;
use yii\web\Response;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;
use modules\sitemap\models\backend\Sitemap;
use modules\sitemap\models\backend\SearchSitemap;

/**
 * SitemapController implements the CRUD actions for Sitemap model.
 */
class SitemapController extends Controller
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
     * @return array
     */
    public function actionGenerate()
    {
        Yii::$app->response->format = Response::FORMAT_JSON; /* клиент принимает ответ в json */
        $model = new Sitemap();
        $model->clearSitemapsDirectory(); // чистим перед записью новых
        $result = $model->generateFrontSitemap();
        $model->generateTendersSitemap();
        $model->generateIndexSitemap();


        return [
            'status' => 'success',
            'result' => 'Записано символов: '.$result
        ];
    }


    /**
     * Lists all Sitemap models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SearchSitemap();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Sitemap model.
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
     * Creates a new Sitemap model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Sitemap();

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
     * Updates an existing Sitemap model.
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
     * Deletes an existing Sitemap model.
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
     * Finds the Sitemap model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Sitemap the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Sitemap::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException(Yii::t('app', 'ERROR_404'));
        }
    }
}
