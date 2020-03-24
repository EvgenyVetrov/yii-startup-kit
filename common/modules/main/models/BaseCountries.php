<?php

namespace modules\main\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "countries".
 *
 * @property int $id
 * @property string $code
 * @property string $name
 * @property string $alpha2
 * @property int $sort
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 */
class BaseCountries extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'countries';
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
            [['sort', 'status'], 'integer'],
            [['code'], 'string', 'max' => 3],
            [['name'], 'string', 'max' => 30],
            [['alpha2'], 'string', 'max' => 2],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'   => 'ID',
            'code'  => 'Code',
            'name'   => 'Название страны',
            'alpha2'  => 'Alpha2',
            'sort'     => 'Sort',
            'status'    => 'Статус',
            'created_at' => 'Создано',
            'updated_at'  => 'Обновлено',
        ];
    }


    /**
     * Возвращает массив стран
     * ключ - id страны, значение - название
     * @return array
     */
    public function valuesAll()
    {
        return ArrayHelper::map(self::find()
            ->where(['status' => 1])
            ->orderBy(['sort' => SORT_DESC, 'name' => SORT_ASC])
            ->all(), 'id', 'name');
    }
}
