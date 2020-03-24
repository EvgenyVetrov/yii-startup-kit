<?php
/**
 * Created by PhpStorm.
 * User: vetrov
 * Date: 17.04.2019
 * Time: 9:53
 */

namespace modules\main\models\backend;

use Yii;
use modules\main\models\BaseGeneralSettings;

class GeneralSettings extends BaseGeneralSettings
{

    /**
     * Возвращает список модулей, доступных в бекенде
     * Удаляем модули из списка, которые сугубо технические.
     * @return array
     */
    public static function getModulesList()
    {
        $modules = array_keys(Yii::$app->getModules());
        $modules = array_combine($modules, $modules);
        unset($modules['gii']);
        unset($modules['debug']);
        return $modules;
    }



    /**
     * Набор лейблов для модулей
     * @return array
     */
    public static function modulesLabels()
    {
        return [
            'blog' => 'Блог',
            'main'  => 'Общий',
            'rbac'   => 'Права и правила доступа',
            'site'    => 'Морда сайта',
            'users'    => 'Пользователи',
            'tender'    => 'Закупки',
            'offers'     => 'Отклики (предложения)',
            'sitemap'     => 'Sitemap',
            'feedback'     => 'Обратная связь',
            'organisations' => 'Организации',
        ];
    }



    /**
     * Получаем лейбл модуля при обращении через this или при передаче напрямую кода модуля
     * @param string $module_name - "offers"
     * @return string -  'Отклики (предложения)'
     */
    public function getModuleLabel($module_name = false)
    {
        if (!$module_name) {
            $moduleLabel = $this->modulesLabels()[$this->module];
            if (!$moduleLabel) { $moduleLabel = $this->module; }
            return $moduleLabel;
        }

        $moduleLabel = $this->modulesLabels()[$module_name];
        if (!$moduleLabel) { $moduleLabel = $module_name; }
        return $moduleLabel;
    }



    /**
     * Возвращает список настроек для конкретного модуля
     * @param $module_name
     * @return array|GeneralSettings[]|\yii\db\ActiveRecord[]
     */
    public static function getModuleSettingsInfo($module_name)
    {
        $settings = self::find()
            ->where(['module' => $module_name])
            ->all();

        $moduleLabel = self::modulesLabels()[$module_name];
        if (!$moduleLabel) { $moduleLabel = $module_name; }

        return [
            'list' => $settings,
            'module_name' => $module_name,
            'module_label' => $moduleLabel
        ];
    }
}