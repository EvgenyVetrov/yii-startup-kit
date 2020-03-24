<?php namespace modules\sitemap\migrations;

use yii\db\Migration;

/**
 * Class m190924_215142_base_sitemap_table
 */
class m190924_215142_base_sitemap_table extends Migration
{
    /**
     * @var string
     */
    protected $table = '{{%sitemap}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable($this->table, [
            'id'          => $this->primaryKey(),
            'name'        => $this->string(50), // название страницы, чтоб проще было пониммать о чем она

            'loc' => $this->string(300), // собственно сама страница, причем относительная
            'lastmod'        => $this->string(30), //
            'changefreq'     => $this->tinyInteger(), // список стабилен, поэтому захардкожен

            'priority' => $this->tinyInteger(), // вообще значения 0.5 и т.п. - десятичные. Ну 0 вначеле подставляется при генерации.

            'own_description' => $this->string(300), // внутренее примечание к категории
            'status'          => $this->tinyInteger(1)->defaultValue(1), // статус
            'created_at'      => $this->integer(),
            'updated_at'      => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable($this->table);
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190924_215142_base_sitemap_table cannot be reverted.\n";

        return false;
    }
    */
}
