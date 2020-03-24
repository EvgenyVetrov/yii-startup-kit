<?php

namespace modules\sitemap;

use yii;

/**
 * Модуль генерации sitemap
 * Связан с другими модулями тесно. Автоматом далеко не все генерирует, много всего руками записывать нужно
 *
 * Class Module
 * @package modules\sitemap
 */
class Module extends \common\components\Module {
    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        $this->registerTranslations();
    }

    /**
     * Регистрируем перевод.
     */
    public function registerTranslations()
    {
        Yii::$app->i18n->translations['modules/sitemap/*'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'basePath' => '@modules/sitemap/messages',
            'fileMap' => [
                'modules/sitemap/main' => 'main.php'
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
        return Yii::t('modules/sitemap/' . $category, $message, $params, $language);
    }
}