<?php

namespace modules\main\controllers\backend;

use modules\feedback\models\backend\Feedback;
use modules\tender\components\TenderNotifications;
use modules\tender\models\backend\Tenders;
use modules\users\models\backend\Users;
use yii\web\Controller;
use yii\filters\AccessControl;

/**
 * Class DefaultController
 * @package modules\main\controllers\backend
 */
class DefaultController extends Controller{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only'  => ['task-manager'],
                'rules' => [
                    [
                        'allow'   => true,
                        'actions' => ['task-manager'],
                        'roles'   => ['task-manager'],
                    ],
                ],
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction'
            ],
        ];
    }
    
    /**
     * Главная страница админки
     * Backend!!
     * @return string
     */
    public function actionIndex()
    {

        return $this->render('index', [
            'active_emails'  => Users::countActiveEmails(),
            'new_feedbacks'  => Feedback::countNewFeedbacks(),
        ]);
    }
}