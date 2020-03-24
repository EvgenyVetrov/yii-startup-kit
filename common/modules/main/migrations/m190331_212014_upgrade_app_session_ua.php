<?php

namespace modules\main\migrations;
use yii\db\Migration;

/**
 * Class m190331_212014_upgrade_app_session_ua
 */
class m190331_212014_upgrade_app_session_ua extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('app_session', 'ua', $this->string(512));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190331_212014_upgrade_app_session_ua cannot be reverted.\n";
    }

}
