<?php

namespace modules\site;

use themes\kit\Theme;
use yii;

/**
 * Модуль морды сайта.
 * использует другую тему и лейаут для вывода информации
 *
 * По идее должен быть доступен всем, даже незалогиненным.
 *
 * Class Module
 * @package modules\site
 */
class Module extends \common\components\Module {
    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        $this->registerTranslations();

        //Yii::$app->view->theme = new Theme();

        /* для морды сайта используется другая тема */
        Yii::$app->view->theme->pathMap = [
            '@frontend/views' => '@themes/kit/views/frontend',
            '@backend/views'  => '@themes/lte/views/backend'
        ];
    }

    /**
     * Регистрируем перевод.
     */
    public function registerTranslations()
    {
        Yii::$app->i18n->translations['modules/site/*'] = [
            'class'    => 'yii\i18n\PhpMessageSource',
            'basePath' => '@modules/site/messages',
            'fileMap'  => [
                'modules/site/main'        => 'main.php',
                'modules/site/filemanager' => 'filemanager.php'
            ]
        ];
    }

    /**
     * Переводим фразу.
     * @param $category
     * @param $message
     * @param array $params
     * @param null $language
     * @return string
     */
    public static function t($category, $message, $params = [], $language = null)
    {
        return Yii::t('modules/site/' . $category, $message, $params, $language);
    }
}