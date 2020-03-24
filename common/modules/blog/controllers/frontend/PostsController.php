<?php

namespace modules\blog\controllers\frontend;

use common\components\GeneralSettings;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\data\ActiveDataProvider;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use modules\blog\models\frontend\BlogPosts;

/**
 * Контроллер для морды сайта. Отображение блога: посты, списки, поиск тоже тут скорее всего будет.
 * PostsController implements the CRUD actions for BlogPosts model.
 */
class PostsController extends Controller
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['index'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index'],
                        'roles' => ['?', '@'],
                    ],
                ],
            ],
        ];
    }



    public function actions()
    {
        return [
            'error' => [
                'class'  => 'yii\web\ErrorAction',
            ],
        ];
    }



    /**
     * Главная страница блога
     * @return mixed
     */
    public function actionIndex()
    {
        $query = BlogPosts::find()
            ->joinWith('category')
            ->where(['status' => BlogPosts::STATUS_ACTIVE])
            ->andWhere(['<=', 'publication_date', time()]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        Yii::$app->params['SEO']['description'] = GeneralSettings::getSetting('blog-seo-description');
        Yii::$app->params['SEO']['keywords'] = GeneralSettings::getSetting('blog-seo-keywords');

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'header_image' => GeneralSettings::getSetting('blog-header-image'),
            'header_h1'    => GeneralSettings::getSetting('blog-header-h1'),
            'blog_title'   => GeneralSettings::getSetting('blog-title')
        ]);
    }



    /**
     * Отображение страницы поста блога.
     *
     * @param $id
     * @return string
     * @throws ForbiddenHttpException
     * @throws NotFoundHttpException
     */
    public function actionView($id)
    {
        $model = BlogPosts::findModel($id);
        if (!$model->canViewPost()) {
            throw new ForbiddenHttpException('Пост #'. $model->id . ' не доступен.');
        }

        return $this->render('view', [
            'model' => $model,
        ]);
    }

}
