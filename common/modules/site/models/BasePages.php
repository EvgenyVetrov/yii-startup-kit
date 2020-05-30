<?php

namespace modules\site\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\web\NotFoundHttpException;

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
 * @property string|null $title
 * @property string|null $keywords
 * @property string|null $description
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
    const STATUS_DRAFT  = 0;
    const STATUS_ACTIVE = 1;

    const TYPE_HARDCODE = 0;
    const TYPE_VIRTUAL  = 1;

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
            [['title', 'keywords', 'description'], 'string', 'max' => 50],
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
            'name' => 'Название',
            'location' => 'URL',
            'content' => 'HTML содержимое',
            'js' => 'Js',
            'custom_head' => 'Custom Head',
            'robots' => 'Robots',
            'blocks_ids' => 'Blocks Ids',
            'sitemap_lastmod' => 'Sitemap Lastmod',
            'sitemap_changefreq' => 'Sitemap Changefreq',
            'sitemap_priority' => 'Sitemap Priority',
            'type' => 'Тип страницы',
            'own_description' => 'Внутренне примечание',
            'status' => 'Статус',
            'created_at' => 'Создано',
            'updated_at' => 'Обновлено',
        ];
    }



    /**
     * Возвращает список статусов
     * @return array
     */
    public static function statusLabels() {
        return [
            self::STATUS_DRAFT  => 'черновик',
            self::STATUS_ACTIVE => 'aктивно'
        ];
    }


    /**
     * Возвращает список типов
     * @return array
     */
    public static function typeLabels() {
        return [
            self::TYPE_HARDCODE => 'Хардкодная',
            self::TYPE_VIRTUAL  => 'Виртуальная'
        ];
    }


    public function behaviors()
    {
        return [
            TimestampBehavior::class,
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
    public static function findModel($id) {
        if (($model = self::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('Страницы #'. $id .' не существует');
        }
    }
}
