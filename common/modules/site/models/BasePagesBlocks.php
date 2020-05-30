<?php

namespace modules\site\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\web\NotFoundHttpException;

/**
 * This is the model class for table "pages_blocks".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $alias
 * @property string|null $content
 * @property string|null $own_description
 * @property int|null $status
 * @property int|null $created_at
 * @property int|null $updated_at
 */
class BasePagesBlocks extends \yii\db\ActiveRecord
{
    const STATUS_DRAFT  = 0;
    const STATUS_ACTIVE = 1;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pages_blocks';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['content'], 'string'],
            [['status', 'created_at', 'updated_at'], 'integer'],
            [['name', 'alias'], 'string', 'max' => 50],
            [['own_description'], 'string', 'max' => 800],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'alias' => 'Alias',
            'content' => 'Content',
            'own_description' => 'Внутреннее примечание',
            'status' => 'Статус',
            'created_at' => 'Создано',
            'updated_at' => 'Обновлено',
        ];
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::class,
        ];
    }


    /**
     * Возвращает список статусов
     * @return array
     */
    public static function statusLabels() {
        return [
            self::STATUS_DRAFT  => 'черновик',
            self::STATUS_ACTIVE => 'активен'
        ];
    }



    /**
     * Поиск модели и обработка эксцепшенов
     * чтоб каждый раз не писать в контроллерах этот метод
     *
     * @param $id
     * @return null|static
     * @throws NotFoundHttpException
     */
    public static function findModel($id) {
        if (($model = self::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('Блока #'. $id .' не существует');
        }
    }
}
