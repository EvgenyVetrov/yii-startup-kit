<?php

namespace modules\sitemap\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "sitemap".
 *
 * @property int $id
 * @property string $name
 * @property string $loc
 * @property string $lastmod
 * @property int $changefreq
 * @property int $priority
 * @property string $own_description
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 */
class BaseSitemap extends \yii\db\ActiveRecord
{
    const STATUS_DRAFT  = 0;
    const STATUS_ACTIVE = 1;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sitemap';
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
            [['name'], 'string', 'max' => 50],
            [['loc', 'own_description'], 'string', 'max' => 300],
            [['loc'], 'required'],
            [['lastmod'], 'string', 'max' => 30],
            [['changefreq', 'priority'], 'string', 'max' => 3],
            [['status'], 'default', 'value' => 1],
            [['status'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'         => 'ID',
            'name'       => 'Название',
            'loc'        => 'Loc',
            'lastmod'    => 'Lastmod',
            'changefreq' => 'Changefreq',
            'priority'   => 'Priority',
            'own_description' => 'Примечание',
            'status'     => 'статус',
            'created_at' => 'создано',
            'updated_at' => 'обновлено',
        ];
    }



    /**
     * @return array
     */
    public static function statusLabels() {
        return [
            0 => 'черновик',
            1 => 'aктивно'
        ];
    }



    /**
     * По сути библиоткеа для changefreq
     * @return array
     */
    public static function changefreqValues()
    {
        return [
            0 => 'не указано',
            1 => 'always',
            2 => 'hourly',
            3 => 'daily',
            4 => 'weekly',
            5 => 'monthly',
            6 => 'yearly',
            7 => 'never'
        ];
    }



    /**
     * Возвращает путь до директории где хранятся файлы с сайтмапами
     *
     * @param string $mode
     * @return string
     */
    public function getSitemapPath($mode = 'alias')
    {
        if ($mode == 'full') {
            return Yii::getAlias('@files')  . '/sitemaps/';
        }
        if ($mode == 'alias') {
            return '@files/sitemaps/';
        }
        if ($mode == 'web') {
            return '/files/sitemaps/';
        }
    }
}
