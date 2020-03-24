<?php

namespace modules\main\controllers\frontend;

use common\components\Hash;
use common\components\VarDumper;
use modules\account\models\frontend\Account;
use modules\account\models\frontend\Analytics;
use modules\main\models\backend\Cities;
use modules\main\models\backend\Districts;
use modules\users\models\backend\search\Users;
use yii;
use yii\web\Controller;
use themes\landing\Theme;
use yii\filters\AccessControl;

/**
 * Class DefaultController
 * @package modules\main\controllers\frontend
 */
class DefaultController extends Controller{
    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        $this->layout = 'empty';
    }

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
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * @return string
     */
    public function actionPolicy()
    {
        return $this->render('policy');
    }

    /**
     * @return string
     */
    public function actionOffer()
    {
        return $this->render('offer');
    }

    /**
     * Метод для наполнения селектора областей.
     * Запрашивается по ajax
     * @param $country
     * @return string
     */
    public function actionGetDistricts($country)
    {
        $model = new Districts();
        $districts = $model->valuesAll($country);
        return $this->renderPartial('_districts', ['districts' => $districts]);
    }

    /**
     * Метод для наполнения селектора городов.
     * Запрашивается по ajax
     * @param $district
     * @return string
     */
    public function actionGetCities($district)
    {
        $cities = (new Cities())->getCities($district);
        return $this->renderPartial('_cities', ['cities' => $cities]);
    }

}