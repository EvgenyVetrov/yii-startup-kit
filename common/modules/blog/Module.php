<?php

namespace modules\blog;


use yii;
use themes\kit\Theme;

class Module extends \common\components\Module {
    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        $this->registerTranslations();

        Yii::$app->view->theme = new Theme();

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
        Yii::$app->i18n->translations['modules/blog/*'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'basePath' => '@modules/blog/messages',
            'fileMap' => [
                'modules/blog/main' => 'main.php'
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
        return Yii::t('modules/blog/' . $category, $message, $params, $language);
    }
}