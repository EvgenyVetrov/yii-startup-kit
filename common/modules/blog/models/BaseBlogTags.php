<?php

namespace modules\blog\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "blog_tags".
 *
 * @property int $id
 * @property string $name
 * @property string $canonical_url
 * @property string $seo_keywords
 * @property string $seo_description
 * @property string $bg_image
 * @property string $own_description
 * @property int $created_at
 * @property int $updated_at
 */
class BaseBlogTags extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'blog_tags';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_at', 'updated_at'], 'integer'],
            [['name', 'canonical_url', 'bg_image'], 'string', 'max' => 50],
            [['seo_keywords', 'seo_description'], 'string', 'max' => 250],
            [['own_description'], 'string', 'max' => 1024],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'    => 'ID',
            'name'  => 'Name',
            'canonical_url'     => 'Canonical Url',
            'seo_keywords'      => 'Seo Keywords',
            'seo_description'   => 'Seo Description',
            'bg_image'          => 'Фоновое изображение в шапку',
            'own_description'   => 'Own Description',
            'created_at' => 'создано',
            'updated_at' => 'обновлено',
        ];
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::class,
        ];
    }
}
