<?php
/**
 * Основной модуль, в который добавляются общие части сайта и все что нельзя приписать к другим модулям
 */
namespace modules\main;

use yii;

/**
 * Общий модуль для всего сайта.
 * Те объекты и сущности, которые могут использоваться для всего сайта
 *
 * Class Module
 * @package modules\main
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
        Yii::$app->i18n->translations['modules/main/*'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'basePath' => '@modules/main/messages',
            'fileMap' => [
                'modules/main/main' => 'main.php',
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
        return Yii::t('modules/main/' . $category, $message, $params, $language);
    }
}