<?php

namespace modules\feedback;

use yii;

/**
 * Модуль для обработки обратной связи от пользователей, в том числе жалобы на мошенничество или нарушение правил
 * в закупках, в фирмах и везде где есть кнопка "пожаловаться", "предложить идею", "сообщить об ошибке"
 *
 * Class Module
 * @package modules\feedback
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
        Yii::$app->i18n->translations['modules/feedback/*'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'basePath' => '@modules/feedback/messages',
            'fileMap' => [
                'modules/feedback/main' => 'main.php'
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
        return Yii::t('modules/feedback/' . $category, $message, $params, $language);
    }
}