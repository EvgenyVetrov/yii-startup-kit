<?php namespace modules\main\migrations;

use yii\db\Migration;

class m171004_211838_change_columns extends Migration
{
    /**
     * @var string
     */
    protected $tableCountries = '{{%countries}}';
    protected $tableDistricts = '{{%districts}}';
    protected $tableCities    = '{{%cities}}';

    public function safeUp()
    {
        $this->addColumn($this->tableDistricts, 'sort', "TINYINT(2) NOT NULL DEFAULT '1'");

        $this->alterColumn($this->tableCountries, 'sort', "TINYINT(2) NOT NULL DEFAULT '1'");
        $this->alterColumn($this->tableDistricts, 'sort', "TINYINT(2) NOT NULL DEFAULT '1'");
        $this->alterColumn($this->tableCities,    'sort', "TINYINT(2) NOT NULL DEFAULT '1'");



        $this->alterColumn($this->tableDistricts, 'country_code', "SMALLINT(4)");
        $this->renameColumn($this->tableDistricts, 'country_code', 'country_id');

        $this->renameColumn($this->tableCities, 'district', 'district_id');


    }

    public function safeDown()
    {
        echo "m171004_211838_change_columns cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m171004_211838_change_columns cannot be reverted.\n";

        return false;
    }
    */
}
