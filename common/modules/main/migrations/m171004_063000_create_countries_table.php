<?php
namespace modules\main\migrations;

use yii\db\Migration;

/**
 * Handles the creation of table `countries`.
 */
class m171004_063000_create_countries_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('countries', [
            'id' => $this->primaryKey(),
            'code' => $this->string(3), // кодовое обозначение страны (alpha3). https://ru.wikipedia.org/wiki/ISO_3166-1
            'name' => $this->string(30), // название страны
            'alpha2' => $this->string(2), // кодовое обозначение страны 2 символьное. Хз зачем, но пусть будет
            'sort' => $this->integer(2),

            'status'          => $this->integer(1), // статус https://docs.google.com/spreadsheets/d/17o_ykUVLBWMK5MRmihwnj-sEwnYoFHFtQXk7mlJWC20/edit#gid=0
            'created_at'      => $this->integer(),
            'updated_at'      => $this->integer(),
        ]);

        // todo: добавить индексы
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('countries');
    }
}
