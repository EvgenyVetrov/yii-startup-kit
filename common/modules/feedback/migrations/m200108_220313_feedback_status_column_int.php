<?php namespace modules\feedback\migrations;

use yii\db\Migration;

/**
 * Class m200108_220313_feedback_status_column_int
 */
class m200108_220313_feedback_status_column_int extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('feedback', 'status', $this->tinyInteger(1)->defaultValue(0));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200108_220313_feedback_status_column_int cannot be reverted.\n";
    }
}
