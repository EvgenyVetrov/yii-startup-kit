<?php
namespace modules\main\migrations;


use yii\db\Migration;

/**
 * Handles the creation of table `districts`.
 */
class m171004_063037_create_districts_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('districts', [
            'id' => $this->primaryKey(),

            'country_code' => $this->string(3), // кодовое обозначение страны (alpha3). Дублируется из country для связи со страной
            'name' => $this->string(30), // название области (штата, района)
            'code' => $this->string(10), // местный код района (области, штат), если есть.

            'status'          => $this->integer(1), // статус https://docs.google.com/spreadsheets/d/17o_ykUVLBWMK5MRmihwnj-sEwnYoFHFtQXk7mlJWC20/edit#gid=0
            'created_at'      => $this->integer(),
            'updated_at'      => $this->integer(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('districts');
    }
}
