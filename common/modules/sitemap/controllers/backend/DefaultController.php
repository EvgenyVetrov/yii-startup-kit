<?php

namespace modules\sitemap\controllers\backend;

use modules\main\models\backend\GeneralSettings;
use Yii;
use modules\sitemap\models\backend\Sitemap;
use modules\sitemap\models\backend\SearchSitemap;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SitemapController implements the CRUD actions for Sitemap model.
 */
class DefaultController extends Controller
{


    /**
     * @return string
     */
    public function actionDashboard()
    {
        $settings = GeneralSettings::getModuleSettingsInfo('sitemap');

        return $this->render('dashboard', [
            'general_settings_info' => $settings
        ]);
    }


}
