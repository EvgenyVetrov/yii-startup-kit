<?php

namespace modules\main\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "general_settings".
 *
 * @property int $id
 * @property string $alias
 * @property string $module
 * @property string $name
 * @property string $description
 * @property string $value
 * @property int $type
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 */
class BaseGeneralSettings extends \yii\db\ActiveRecord
{
    const STATUS_DRAFT  = 0;
    const STATUS_ACTIVE = 1;

    const TYPE_DEFAULT   = 0;
    const TYPE_INTEGER   = 1;
    const TYPE_STRING    = 2;
    const TYPE_IMAGE_URL = 3;
    const TYPE_IMAGE_SVG = 4; // 1000 знаков недостаточно для хранения SVG

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'general_settings';
    }


    public function behaviors()
    {
        return [
            TimestampBehavior::class,
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_at', 'updated_at'], 'integer'],
            [['alias', 'module'], 'string', 'max' => 40],
            [['name'], 'string', 'max' => 50],
            [['description'], 'string', 'max' => 100],
            [['value'], 'string', 'max' => 1000],
            [['type'], 'integer', 'max' => 99],
            [['status'], 'integer', 'max' => 9],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'          => 'ID',
            'alias'       => 'Алиас',
            'module'      => 'Модуль',
            'name'        => 'Название',
            'description' => 'Описание',
            'value'       => 'Значение',
            'type'        => 'Тип значения',
            'status'      => 'Статус',
            'created_at'  => 'Создано',
            'updated_at'  => 'Обновлено',
        ];
    }

    public function typeLabels()
    {
        return [
            self::TYPE_DEFAULT    => 'без типизации',
            self::TYPE_INTEGER    => 'целое число',
            self::TYPE_STRING     => 'строка',
            self::TYPE_IMAGE_URL  => 'URL картинки',
            self::TYPE_IMAGE_SVG  => 'SVG картинка (!)',
        ];
    }


    /**
     * Заголовки статусов
     * @return array
     */
    public function statusLabels()
    {
        return [
            0 => 'черновик',
            1 => 'активно',
        ];
    }



    /**
     * Поиск модели и обработка эксцепшенов
     * чтоб каждый раз не писать в контроллерах этот метод
     *
     * @param $user_id
     * @return null|static
     * @throws NotFoundHttpException
     */
    public static function findModel($user_id) {
        if (($model = self::findOne($user_id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('Настройки #'. $user_id .' не существует');
        }
    }
}
