<?php namespace modules\users\migrations;

use yii\db\Migration;

class m171120_070717_add_current_org_column extends Migration
{
    public $table = '{{%users}}';

    public function safeUp()
    {
        // храним id организации которую на текущий момент выбрал юзер ибо все дальнейшие действия от имени этой организации будут
        $this->addColumn($this->table, 'current_organisation', $this->integer());
    }

    public function safeDown()
    {
        $this->dropColumn($this->table, 'current_organisation');
    }

}
