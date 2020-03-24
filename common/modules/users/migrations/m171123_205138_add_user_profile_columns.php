<?php namespace modules\users\migrations;

use yii\db\Migration;

class m171123_205138_add_user_profile_columns extends Migration
{
    public $table = '{{%users}}';

    public function safeUp()
    {
        $this->addColumn($this->table, 'patronymic', 'VARCHAR(50) AFTER `last_name` ');
        $this->addColumn($this->table, 'contacts', $this->string(800)->after('patronymic'));
        $this->addColumn($this->table, 'avatar', $this->string(50)->after('contacts'));
    }

    public function safeDown()
    {
        $this->dropColumn($this->table, 'patronymic');
        $this->dropColumn($this->table, 'contacts');
        $this->dropColumn($this->table, 'avatar');
    }

}
