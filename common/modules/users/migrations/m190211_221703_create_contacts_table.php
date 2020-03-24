<?php
namespace modules\users\migrations;

use yii\db\Migration;

/**
 * Handles the creation of table `contacts`.
 */
class m190211_221703_create_contacts_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('contacts', [
            'id'          => $this->primaryKey(),
            'user_id'     => $this->integer()->defaultValue(0),
            'type'        => $this->tinyInteger()->defaultValue(0),
            'title'       => $this->string(50),   // название контакта (телефон, скайп и тд)
            'description' => $this->string(250),
            'value'       => $this->string(500), // значение. Нельзя править после подтверждения

            'confirm_status' => $this->tinyInteger(1)->defaultValue(0), // 0 - не подтверждено 1 - подтверждено 2 - отклонено
            'confirm_json'   => $this->json(), // Всякая инфа в JSON (кто подтвердил и тп, чтоб джоины не делать)
            'confirm_user'   => $this->integer()->defaultValue(0),
            'confirm_code'   => $this->string(50),

            'status'          => $this->tinyInteger(2)->defaultValue(0), // статус контакта
            'own_description' => $this->string(500),
            'created_at'      => $this->integer(),
            'updated_at'      => $this->integer()


        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('contacts');
    }
}
