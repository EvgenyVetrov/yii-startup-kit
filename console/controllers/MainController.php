<?php

namespace console\controllers;

use common\components\SendMail;
use modules\main\models\backend\Cities;
use modules\main\models\backend\Countries;
use modules\main\models\backend\Districts;
use yii;
use yii\console\Controller;

/**
 * Class MainController
 * @package console\controllers
 */
class MainController extends Controller
{
    /**
     * Refresh schema cache
     */
    public function actionSchemaRefresh()
    {
        Yii::$app->db->schema->refresh();
        Yii::info('Refresh schema cache', 'app');
    }

}



