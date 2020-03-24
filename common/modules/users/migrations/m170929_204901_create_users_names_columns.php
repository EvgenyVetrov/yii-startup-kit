<?php
namespace modules\users\migrations;

use yii\db\Migration;

/**
 * Class m170929_204901_create_users_names_columns
 */
class m170929_204901_create_users_names_columns extends Migration
{
    /**
     * @var string
     */
    protected $table = '{{%users}}';

    public function safeUp()
    {
        $this->addColumn($this->table, 'last_name', $this->string(50)->null()->after('name'));
        $this->renameColumn($this->table, 'name', 'first_name');
    }

    public function safeDown()
    {
        $this->dropColumn($this->table, 'last_name');
        $this->renameColumn($this->table, 'first_name', 'name');

        return true;
    }
}
