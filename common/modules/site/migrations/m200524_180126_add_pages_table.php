<?php namespace modules\site\migrations;

use yii\db\Migration;

/**
 * Class m200524_180126_add_pages_table
 */
class m200524_180126_add_pages_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('pages', [
            'id'          => $this->primaryKey(),
            'name'        => $this->string(50), // название страницы, чтоб проще было пониммать о чем она

            'location'       => $this->string(500), // собственно сама страница, причем относительная. Урл
            'content'        => $this->text(),
            'js'             => $this->text(),
            'custom_head'    => $this->text(),
            'robots'         => $this->string(50),

            'blocks_ids'         => $this->text(), // список связных блоков через запятую id-шники

            'sitemap_lastmod'        => $this->string(30), // для sitemap в форате sitemap
            'sitemap_changefreq'     => $this->tinyInteger(), // список стабилен, поэтому захардкожен
            'sitemap_priority' => $this->tinyInteger(), // вообще значения 0.5 и т.п. - десятичные. Ну 0 вначеле подставляется при генерации.

            'type' => $this->tinyInteger(1)->defaultValue(0), // тип страницы:  хардкодная или виртуальная.

            'own_description' => $this->string(800), // внутренее примечание к странице
            'status'          => $this->tinyInteger(1)->defaultValue(0), // статус
            'created_at'      => $this->integer(),
            'updated_at'      => $this->integer(),
        ]);


        $this->createTable('pages_blocks', [
            'id'       => $this->primaryKey(),
            'name'     => $this->string(50), // название блока, чтоб проще было пониммать о чем она
            'alias'    => $this->string(50), // алиас блока для обращения из кода. Может быть не уникальным, чтоб быстро подменять
            'content'        => $this->text(), // html содержимое

            'own_description' => $this->string(800), // внутренее примечание к блоку
            'status'          => $this->tinyInteger(1)->defaultValue(0), // статус
            'created_at'      => $this->integer(),
            'updated_at'      => $this->integer(),
        ]);
    }



    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('pages');
        $this->dropTable('pages_blocks');
    }

}
