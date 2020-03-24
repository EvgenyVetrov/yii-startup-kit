<?php namespace modules\main\migrations;

use yii\db\Migration;

/**
 * Class m200131_071057_add_tasks_log_table
 */
class m200131_071057_add_tasks_log_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('tasks_logs', [
            'id'   => $this->primaryKey(),
            'task' => $this->smallInteger(4)->defaultValue(0),
            'processed_counter' => $this->integer()->defaultValue(0),
            'success_counter'   => $this->integer()->defaultValue(0),
            'data'      => $this->text(),
            'status'    => $this->tinyInteger()->defaultValue(0),
            'initiator' => $this->tinyInteger()->defaultValue(0),
            'previous_log_offset' => $this->integer()->defaultValue(0),
            'task_start_at'       => $this->integer()->defaultValue(0),
            'created_at'          => $this->integer()->defaultValue(0),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('tasks_logs');
    }

}
