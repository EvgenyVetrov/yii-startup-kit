<?php

namespace modules\site\models;

use Yii;

/**
 * This is the model class for table "pages".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $location
 * @property string|null $content
 * @property string|null $js
 * @property string|null $custom_head
 * @property string|null $robots
 * @property string|null $blocks_ids
 * @property string|null $sitemap_lastmod
 * @property int|null $sitemap_changefreq
 * @property int|null $sitemap_priority
 * @property int|null $type
 * @property string|null $own_description
 * @property int|null $status
 * @property int|null $created_at
 * @property int|null $updated_at
 */
class BasePages extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pages';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['content', 'js', 'custom_head', 'blocks_ids'], 'string'],
            [['sitemap_changefreq', 'sitemap_priority', 'type', 'status', 'created_at', 'updated_at'], 'integer'],
            [['name', 'robots'], 'string', 'max' => 50],
            [['location'], 'string', 'max' => 500],
            [['sitemap_lastmod'], 'string', 'max' => 30],
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
            'location' => 'Location',
            'content' => 'Content',
            'js' => 'Js',
            'custom_head' => 'Custom Head',
            'robots' => 'Robots',
            'blocks_ids' => 'Blocks Ids',
            'sitemap_lastmod' => 'Sitemap Lastmod',
            'sitemap_changefreq' => 'Sitemap Changefreq',
            'sitemap_priority' => 'Sitemap Priority',
            'type' => 'Type',
            'own_description' => 'Own Description',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
