<?php
namespace modules\main\models\backend;

use modules\main\models\BaseCities;
/**
 *
 */

class Cities extends BaseCities
{
    /**
     * Возвращает количество активных городов всего
     * для удобства в админке
     * @return int|string
     */
    public static function countActiveCities()
    {
        return self::find()->where(['status' => 1])->count();
    }



    /**
     * Возвращает количество городов в области всего
     * @param $district_id
     * @return int|string
     */
    public static function countAllCitiesPerDistrict($district_id)
    {
        return self::find()->where(['district_id' => $district_id])->count();
    }



    /**
     * Возвращает количество активных городов в области
     * @param $district_id
     * @return int|string
     */
    public static function countActiveCitiesPerDistrict($district_id)
    {
        return self::find()->where(['district_id' => $district_id, 'status' => 1])->count();
    }
}