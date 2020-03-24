<?php

namespace modules\feedback\controllers\frontend;

use Yii;
use yii\web\Response;
use yii\web\Controller;
use modules\feedback\models\frontend\Feedback;


class DefaultController extends Controller
{


    /**
     * Метод для создания нового фидбэка.
     * запрашивается по ajax
     * @return array
     */
    public function actionCreate()
    {
        Yii::$app->response->format = Response::FORMAT_JSON; /* клиент принимает ответ в json */
        $model = new Feedback();
        $model->scenario = Feedback::SCENARIO_JSON;

        if (!Yii::$app->user->isGuest) { $model->email = Yii::$app->user->identity->email; }
        $model->type        = Yii::$app->request->post('type');
        $model->text        = Yii::$app->request->post('text');
        $model->device_info = Yii::$app->request->post('device_info');
        $model->object      = Yii::$app->request->post('object');
        $model->object_id   = Yii::$app->request->post('object_id');
        $model->ip          = Yii::$app->request->getUserIP();
        $model->user_agent  = Yii::$app->request->userAgent;
        $model->user_id     = Yii::$app->user->isGuest ? 0 : Yii::$app->user->id;
        $model->org_id      = Yii::$app->user->isGuest ? 0 : Yii::$app->user->identity->current_organisation;


        if ($model->save()) {
            return [
                'status' => 'success',
                'text'   => 'Ваше обращение принято. Его номер: ' . $model->id
            ];
        } else {
            return [
                'status'    => 'error',
                'text'      => 'Ошибка сохранения обращения',
                'errors_list' => $model->getErrors()
            ];
        }
    }


}
