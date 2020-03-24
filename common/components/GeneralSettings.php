<?php
/**
 * Компонент основных настроек, которые задаются через админку и записываются в базу.
 * Для начала извлекаются из базы, в дальнейшем можно сделать связь базы и кеша.
 */

namespace common\components;

use Yii;
use modules\main\models\BaseGeneralSettings;
use yii\helpers\ArrayHelper;

class GeneralSettings
{
    /**
     * Получение значения настройки сгласно алиаса.
     * @param $alias
     * @return string
     */
    public static function getSetting($alias)
    {
        if (Yii::$app->params['generalSettings'] === false) {
            self::fillSettings();
        }

        return isset(Yii::$app->params['generalSettings'][$alias]) ? Yii::$app->params['generalSettings'][$alias] : '';
    }



    /**
     * Наполнение настроек из базы
     * берет все настройки сразу и заполняет.
     *
     * todo: Если будет очень много настроек, будет выполняться долго и бесполезно. Надо будет как-то оптимизировать стягивание настроек
     */
    private static function fillSettings()
    {
        $settings = BaseGeneralSettings::find()
            ->select(['alias', 'value'])
            ->where(['status' => BaseGeneralSettings::STATUS_ACTIVE])
            ->asArray()
            ->all();

        $settings = ArrayHelper::map($settings, 'alias', 'value');
        Yii::$app->params['generalSettings'] = $settings;
    }
}