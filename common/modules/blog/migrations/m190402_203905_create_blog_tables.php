<?php

namespace modules\blog\migrations;

use yii\db\Migration;

/**
 * Class m190402_203905_create_blog_tables
 */
class m190402_203905_create_blog_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('blog_posts', [
            'id'            => $this->primaryKey(),
            'title'         => $this->string(120),
            'bg_image'      => $this->string(50), // фоновая картинка вверху поста
            'general_image' => $this->string(50), // главная картинка, которая отображается в списке постов
            'alt_image'     => $this->string(250), // alt для главной картинки
            'announce'      => $this->string(1000), // анонс поста, отображается в списке постов
            'text'          => $this->text(), // текст поста в HTML
            'creation_date' => $this->integer()->notNull()->defaultValue(0), // видимая дата создания
            'publication_date' => $this->integer()->notNull()->defaultValue(0),
            'category_id'      => $this->tinyInteger()->notNull()->defaultValue(0), // основная категория, которой принадлежит пост
            'seo_keywords'     => $this->string(250),
            'seo_description'  => $this->string(250),
            'canonical_url'    => $this->string(250), // человеко-понятная ссылка
            'author_id'        => $this->integer()->notNull()->defaultValue(0),
            'status'           => $this->tinyInteger()->notNull()->defaultValue(0),

            'own_description'   => $this->string(1024),
            'created_at'        => $this->integer(),
            'updated_at'        => $this->integer(),

        ]);

        // таблица тегов
        $this->createTable('blog_tags', [
            'id'            => $this->primaryKey(),
            'name'              => $this->string(50),
            'canonical_url'     => $this->string(50), // каноническая ссылка на страницу со списком постов с этим тегом
            'seo_keywords'      => $this->string(250),
            'seo_description'   => $this->string(250),
            'bg_image'          => $this->string(50),

            'own_description'   => $this->string(1024),
            'created_at'        => $this->integer(),
            'updated_at'        => $this->integer(),

        ]);

        // связь тегов и постов
        $this->createTable('blog_tags_relation', [
            'id'       => $this->primaryKey(),
            'post_id'  => $this->integer(),
            'tag_id'   => $this->integer(),
        ]);


        // некие основные категории (новости, блог обзор и тп)
        $this->createTable('blog_categories', [
            'id'            => $this->primaryKey(),
            'name'              => $this->string(50),
            'canonical_url'     => $this->string(50), // каноническая ссылка на страницу со списком постов с этим тегом
            'seo_keywords'      => $this->string(250),
            'seo_description'   => $this->string(250),
            'bg_image'          => $this->string(50),

            'own_description'   => $this->string(1024),
            'created_at'        => $this->integer(),
            'updated_at'        => $this->integer(),
        ]);
    }



    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('blog_posts');
        $this->dropTable('blog_categories');
        $this->dropTable('blog_tags_relation');
        $this->dropTable('blog_tags');

    }

}
