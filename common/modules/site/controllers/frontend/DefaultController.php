<?php

namespace modules\site\controllers\frontend;

use yii;
use yii\web\Controller;
use modules\feedback\models\frontend\Feedback;

/**
 * Экшены связанные с мордой сайта
 * Не забыть эти экшены прописать в frontend/config/main.php что бы разрешить пользоваться всем юзерам, в т.ч. гостям.
 * todo: по идее эти rules нужно переместить сюда, но пока некогда разбираться как это сделать. Пока туда добавлять.
 *
 * Class DefaultController
 * @package modules\main\controllers\frontend
 */
class DefaultController extends Controller{

    /**
     * @inheritdoc
     */
    /*public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['opportunities'],
                        'allow' => true,
                        'roles' => ['?', '@'],
                    ],
                ],
            ]
        ];
    }*/



    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class'  => 'yii\web\ErrorAction',
            ],
        ];
    }



    /**
     * Главная страница сайта
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }



    /**
     * Поддержите нас
     * В том числе тут форма обратной связи
     * todo: входящие данные не фильтруются
     *
     * @return string
     */
    public function actionAbout()
    {

        $model = new Feedback();
        if (!Yii::$app->user->isGuest) { $model->email = Yii::$app->user->identity->email; }
        $model->formTypeList([2, 3, 4, 5, 6, 1, 7, 8, 9, 10, 0]);
        $model->scenario = Feedback::SCENARIO_FRONT;

        if (Yii::$app->request->isPost AND $model->load(Yii::$app->request->post()) AND $model->save()){
            Yii::$app->session->setFlash('success', 'Сообщение успешно отправлено');
            return $this->redirect(['about']);
        } elseif(Yii::$app->request->isPost) {
            Yii::$app->session->setFlash('error', 'Ошибка отправки сообшения');
        }

        return $this->render('about/about', ['model' => $model]);
    }



    /**
     * @return string
     */
    public function actionPolicy()
    {
        return $this->render('policy/policy');
    }



    /**
     * Экшн с лендосом.
     * Для других лендосов будет что-то вроде intro2
     * @return string
     */
    public function actionIntro()
    {
        Yii::$app->params['show_top_menu'] = false;
        Yii::$app->params['show_site_description'] = true;
        return $this->render('intro/first');
    }


}