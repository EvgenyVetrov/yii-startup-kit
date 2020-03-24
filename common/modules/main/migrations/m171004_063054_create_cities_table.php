<?php
namespace modules\main\migrations;


use yii\db\Migration;

/**
 * Handles the creation of table `cities`.
 */
class m171004_063054_create_cities_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('cities', [
            'id' => $this->primaryKey(),

            'name' => $this->string(30), // название населенного пункта
            'district' => $this->integer(), // связь с районом (областью/штатом)

            'population' => $this->integer(), // количество населения в населенном пункте, для удобства выставления  приоритетных городов
            'sort'       => $this->integer(2),
            'status'     => $this->integer(1), // статус https://docs.google.com/spreadsheets/d/17o_ykUVLBWMK5MRmihwnj-sEwnYoFHFtQXk7mlJWC20/edit#gid=0
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('cities');
    }
}
