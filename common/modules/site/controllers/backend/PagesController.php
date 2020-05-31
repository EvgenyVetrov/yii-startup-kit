<?php

namespace modules\site\controllers\backend;

use Yii;
use modules\site\models\backend\Pages;
use modules\site\models\backend\SearchPages;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PagesController implements the CRUD actions for Pages model.
 */
class PagesController extends Controller
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
     * Lists all Pages models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SearchPages();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Pages model.
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
     * Creates a new Pages model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Pages();

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
     * Updates an existing Pages model.
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
     * Deletes an existing Pages model.
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
     * Добавление нового блока
     *
     * @param $page_id
     * @param $block_id
     * @return array
     * @throws NotFoundHttpException
     */
    public function actionSaveBlock($page_id, $block_id) {
        Yii::$app->response->format = yii\web\Response::FORMAT_JSON; /* клиент принимает ответ в json */
        $pageModel = Pages::findModel($page_id);
        $pagesBlockIds = $pageModel->getPagesBlocksIds();
        if (in_array((int) $block_id, $pagesBlockIds)) {
            return [
                'status'  => 'warning',
                'message' => 'Блок #'.$block_id.' уже привязан к данной странице'
            ];
        }

        $pageModel->addPageBlock((int) $block_id);
        if ($pageModel->save()) {
            return [
                'status'  => 'success',
                'message' => 'Блок прикреплен к странице'
            ];
        }

        return [
            'status'     => 'error',
            'message'    => 'Ошибка сохранения страницы.',
            'errorsList' => $pageModel->getErrors()
        ];

    }



    /**
     * Удаление привязки блока
     *
     * @param $page_id
     * @param $block_id
     * @return array
     * @throws NotFoundHttpException
     */
    public function actionDeleteBlock($page_id, $block_id) {
        Yii::$app->response->format = yii\web\Response::FORMAT_JSON; /* клиент принимает ответ в json */
        $pageModel = Pages::findModel($page_id);
        $pagesBlockIds = $pageModel->getPagesBlocksIds();
        if (!in_array((int) $block_id, $pagesBlockIds)) {
            return [
                'status'  => 'warning',
                'message' => 'Блок #'.$block_id.' уже не связан с данной страницей'
            ];
        }

        $pageModel->deletePageBlock((int) $block_id);
        if ($pageModel->save()) {
            return [
                'status'  => 'success',
                'message' => 'Блок отвязан от страницы'
            ];
        }

        return [
            'status'     => 'error',
            'message'    => 'Ошибка сохранения страницы.',
            'errorsList' => $pageModel->getErrors()
        ];

    }





    /**
     * Finds the Pages model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Pages the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Pages::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException(Yii::t('app', 'ERROR_404'));
        }
    }
}
