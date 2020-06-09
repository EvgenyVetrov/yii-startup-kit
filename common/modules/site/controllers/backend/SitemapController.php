<?php
/**
 * Created by PhpStorm.
 * User: evetrov
 * Date: 09.06.20
 * Time: 16:18
 */

namespace modules\site\controllers\backend;

use modules\site\models\backend\Sitemap;
use Yii;
use modules\main\models\backend\GeneralSettings;
use yii\web\Controller;

use yii\web\Response;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;

/**
 * Class SitemapController
 * @package modules\site\controllers\backend
 */
class SitemapController extends Controller
{


    /**
     * Основная панель управления Sitemap
     * @return string
     */
    public function actionDashboard()
    {
        $settings = GeneralSettings::getModuleSettingsInfo('sitemap');

        return $this->render('dashboard', [
            'general_settings_info' => $settings
        ]);
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
        $model->generateIndexSitemap();


        return [
            'status' => 'success',
            'result' => 'Записано символов: '.$result
        ];
    }

}