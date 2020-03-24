<?php
namespace modules\main\migrations;
use yii\db\Migration;

class m171113_181427_add_for_cities_columns extends Migration
{
    public $table = '{{%cities}}';

    public function safeUp()
    {
        $this->addColumn($this->table, 'area', $this->string(100)->null()); // подрайон области
        $this->addColumn($this->table, 'form', $this->string(25)->null()); // форма населенного пункта (город)б деревня и тп
    }

    public function safeDown()
    {
        $this->dropColumn($this->table, 'area');
        $this->dropColumn($this->table, 'form');

        return true;
    }

}
