<?php

namespace modules\main\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "cities".
 *
 * @property int $id
 * @property string $name
 * @property string $area
 * @property int $district_id
 * @property int $population
 * @property int $sort
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 */
class BaseCities extends \yii\db\ActiveRecord
{
    const STATUS_DRAFT = 0;
    const STATUS_ACTIVE = 1;

    const STATUS_LABELS = [
        self::STATUS_ACTIVE => 'Активен',
        self::STATUS_DRAFT  => 'Черновик',
    ];

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cities';
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['district_id', 'name', 'sort', 'status'], 'required'],
            [['district_id', 'population', 'sort', 'status'], 'integer'],
            [['name'], 'string', 'max' => 40],
            [['form'], 'string', 'max' => 25],
            [['area'], 'string', 'max' => 60],
            [['sort'], 'default', 'value' => 1],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'          => 'ID',
            'name'        => 'Населенный пункт',
            'area'        => 'Район',
            'district_id' => 'Область',
            'population'  => 'Население',
            'sort'        => 'Сортировка',
            'status'      => 'Статус',
            'created_at'  => 'Создано',
            'updated_at'  => 'Обновлено',
        ];
    }



    /**
     * Возвращает массив городов (населенных пунктов)
     * ключ - id области, значение - название области
     *
     * @param integer $district - id области для которой нужно вернуть населенные пункты
     * @return object
     */
    public function getCities($district)
    {
        return self::find()
            ->where(['district_id' => $district])
            ->andWhere(['status' => 1])
            ->orderBy(['sort' => SORT_DESC, 'name' => SORT_ASC])
            ->all();
    }



    /**
     * Возвращает название области для текущего города
     * @return bool|string
     */
    public function getDistrictName()
    {
        if (!$this->district_id) { return false; }
        $districtModel = BaseDistricts::findOne(['id' => $this->district_id]);
        return $districtModel->name;
    }


    /**
     * Готовый массив возможных статусов, что бы потом отобразить его в дропдауне
     * @return array
     */
    public static function statuses(){
        return self::STATUS_LABELS;
    }
}
