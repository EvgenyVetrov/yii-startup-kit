<?php

namespace modules\users\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "contacts".
 *
 * @property int $id
 * @property int $user_id
 * @property int $type
 * @property string $title
 * @property string $description
 * @property string $value
 * @property int $confirm_status
 * @property array $confirm_json
 * @property int $confirm_user
 * @property string $confirm_code
 * @property int $status
 * @property string $own_description
 * @property int $created_at
 * @property int $updated_at
 */
class BaseContacts extends \yii\db\ActiveRecord
{
    const TYPE_UNDEFINED = 0; // тип контакта не определен
    const TYPE_PHONE     = 1;
    const TYPE_EMAIL     = 2;
    const TYPE_MESSENGER = 3;
    const TYPE_ADDRESS   = 4;
    const TYPE_SOCIAL_NETWORK  = 5;
    const TYPE_SITE      = 6;
    const TYPE_OTHER     = 90; // прочий тип контакта


    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'contacts';
    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'confirm_user', 'created_at', 'updated_at'], 'integer', 'message' => 'Должно быть число'],
            [['confirm_json'], 'safe'],
            [['type'], 'string', 'max' => 3],
            [['title', 'confirm_code'], 'string', 'max' => 50],
            [['description'], 'string', 'max' => 250],
            [['value', 'own_description'], 'string', 'max' => 500],
            [['confirm_status'], 'string', 'max' => 1],
            [['status'], 'string', 'max' => 2],
        ];
    }


    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'                => 'ID',
            'user_id'           => 'Пользователь',
            'type'              => 'Тип',
            'title'             => 'Заголовок',
            'description'       => 'Примечание',
            'value'             => 'Значение',
            'confirm_status'    => 'Статус подтверждения',
            'confirm_json'      => 'Confirm Json',
            'confirm_user'      => 'Подтвердивший пользователь',
            'confirm_code'      => 'Код подтверждения',

            'status'            => 'Статус',
            'own_description'   => 'Own Description',
            'created_at'        => 'Создано',
            'updated_at'        => 'Обновлено',
        ];
    }


    public function behaviors()
    {
        return [
            TimestampBehavior::class,
        ];
    }
}