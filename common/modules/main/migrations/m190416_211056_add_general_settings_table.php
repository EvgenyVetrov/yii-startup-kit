<?php namespace modules\main\migrations;

use yii\db\Migration;

/**
 * Class m190416_211056_add_general_settings_table
 */
class m190416_211056_add_general_settings_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('general_settings', [
            'id'    => $this->primaryKey(),
            'alias' => $this->string(40), // удобночитаемый алиас
            'module' => $this->string(40), // модуль, которому принадлежит настройка
            'name'  => $this->string(50), // название настройки
            'description' => $this->string(100), // описание
            'value' => $this->string(1000), // значение
            // тип: (число, строка, ссылка на картинку, svg  итп). Полезно для быстрого просмотра.
            // Может потом в кеше соптимизировать можно что-то будет
            'type' => $this->tinyInteger(2)->notNull()->defaultValue(0),

            // статус. Могут быть несколько настроек с 1 алиасом, но берется только первый активный
            'status'          => $this->tinyInteger(1)->notNull()->defaultValue(0),
            'created_at'      => $this->integer(),
            'updated_at'      => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('general_settings');

    }

}
