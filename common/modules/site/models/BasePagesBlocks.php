<?php

namespace modules\site\models;

use Yii;

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
            'name' => 'Name',
            'alias' => 'Alias',
            'content' => 'Content',
            'own_description' => 'Own Description',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
