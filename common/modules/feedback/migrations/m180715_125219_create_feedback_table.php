<?php namespace modules\feedback\migrations;

use yii\db\Migration;

/**
 * Таблица для модуля "feedback"
 * Предполагается что тут будут храниться все жалобы, предложения и обращения.
 * Других таблиц пока не предусмотрено
 *
 * Handles the creation of table `feedback`.
 */
class m180715_125219_create_feedback_table extends Migration
{
    /**
     * @var string
     */
    protected $table = '{{%feedback}}';

    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable($this->table, [
            'id'         => $this->primaryKey(),
            'user_id'    => $this->integer()->defaultValue(0), // юзер который оставил обращение. Если юзера нет (например с сайта), тогда 0
            'email'      => $this->string(54), // ip адрес
            'org_id'     => $this->integer()->defaultValue(0), // текущая организация пользователя, если нет = 0
            'type'       => $this->tinyInteger()->defaultValue(0), // тип обращения (куча типов будет для подробности)
            'object'     => $this->tinyInteger()->defaultValue(0), // объект на который идет обращение (жалоба на тендер, жалоба на юзера и тд...)
            'object_id'  => $this->integer()->defaultValue(0), // id объекта на который идет обращение
            'text'       => $this->string(1000), // текст обращения
            'ip'         => $this->string(54), // ip адрес
            'user_agent' => $this->string(500), // юзерагент. Они могут быть достаточно длинными
            'device_info' => $this->text(), // инфа о девайсе в виде json (разрешение, ос, скорость соединение и прочее, что удасться собрать JS)

            'own_description' => $this->string(1000), // внутренее примечание
            'status'          => $this->tinyInteger(2)->defaultValue(0), // внутренний статус (систему статусов еще придумать надо: в работе, не отвечен, решен и тд)
            'created_at'      => $this->integer(),
            'updated_at'      => $this->integer(),

        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable($this->table);
    }
}
