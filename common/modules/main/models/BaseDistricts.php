<?php

namespace modules\main\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "districts".
 *
 * @property int $id
 * @property int $country_id
 * @property string $name
 * @property string $code
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 * @property int $sort
 */
class BaseDistricts extends \yii\db\ActiveRecord
{
    const STATUS_DRAFT  = 0;
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
        return 'districts';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['country_id', 'status', 'created_at'], 'integer'],
            [['name'], 'string', 'max' => 30],
            [['code'], 'string', 'max' => 10],
        ];
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
    public function attributeLabels()
    {
        return [
            'id'         => 'ID',
            'country_id' => 'ID страны',
            'name'       => 'Название области',
            'code'       => 'Code',
            'status'     => 'Статус',
            'created_at' => 'Создано',
            'updated_at' => 'Обновлено',
            'sort'       => 'Приоритет сортировки',
        ];
    }


    /**
     * Возвращает массив областей (штатов)
     * ключ - id области, значение - название области
     *
     * @param integer $country - id страны для которой нужно вернуть области
     * @return mixed
     */
    public function valuesAll($country)
    {
        return ArrayHelper::map(self::find()
            ->where(['country_id' => $country])
            ->andWhere(['status' => 1])
            ->orderBy(['sort' => SORT_DESC, 'name' => SORT_ASC])
            ->all(), 'id', 'name');
    }


    /**
     * Готовый массив возможных статусов, что бы потом отобразить его в дропдауне
     * @return array
     */
    public static function statuses(){
        return self::STATUS_LABELS;
    }
}
