<?php
namespace modules\users\migrations;

use yii\db\Migration;

/**
 * Handles the creation of table `profiles`.
 */
class m190211_215628_create_profiles_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('profiles', [
            'id'        => $this->primaryKey(),
            'user_id'   => $this->integer(),                            // связь с юзером. У 1 юзера может быть много профилей
            'org_id'    => $this->integer()->defaultValue(0),   // связь с организацией. к 1 организации у 1 человека можжет быть только 1 профиль
            'json_contacts'     => $this->json(),                       // по идее ссылка на подтвержденные контакты
            'custom_contacts' => $this->string(1000),           // контакты для этой организации
            'role'      => $this->tinyInteger(2)->defaultValue(0),     // роль (владелец, админ, модератор и тл.. типа как в вк)
            'position'  => $this->string(120),                  // должность

            'invite_status' => $this->tinyInteger(1)->defaultValue(0), // статус приглащения в организацию (0 - не подтвержден 1 - подтвержден 2 - отклонен)
            'invite_date'   => $this->integer()->defaultValue(0),             // дата отправки приглашения
            'invite_user'   => $this->integer()->defaultValue(0),             // id юзера, пригласившего в орагнизацию

            // сопроводительное письмо к приглашению не нужно ибо превратится в спам расылку по юзерам

            'status'            => $this->tinyInteger(2)->defaultValue(0), // статус профиля
            'own_description'   => $this->string(700),
            'created_at'        => $this->integer(),
            'updated_at'        => $this->integer()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('profiles');
    }
}
