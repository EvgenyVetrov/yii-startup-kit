<?php

namespace modules\main\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "tasks_logs".
 * Логи работы всевозможных скриптов
 *
 * @property int $id
 * @property int $task
 * @property int $processed_counter
 * @property int $success_counter
 * @property string $data
 * @property int $status
 * @property int $initiator
 * @property int $previous_log_offset - сколько секунд назад был сделан предыдущий запуск (любой успешный или нет)
 *                                      todo: пока не используется и не заполняется
 * @property int $task_start_at       - timestamp начала задачи. Не записи в базу, а когда начал работать скрипт изначально.
 *                                      то есть в начале работы скрипта нужно запомнить time()  в переменную
 * @property int $created_at
 */
class TasksLogs extends \yii\db\ActiveRecord
{
    const STATUS_DRAFT   = 0; // черновик. До начала выполнения скрипта/задачи
    const STATUS_CORRECT = 1; // когда задача выполнена корректно
    const STATUS_FAIL    = 2; // когда произошел фейл задачи

    const TASK_NOTIFY_NEW_TENDERS = 1;
    const TASK_SEND_MAIL          = 2; // просто отправка письма. Без привязки к инициатору

    /**
     * Названия задач
     * @return array
     */
    public static function tasksLabels()
    {
        return [
            self::TASK_NOTIFY_NEW_TENDERS => 'Отправка уведомлений о найденных закупках на Email',
            self::TASK_SEND_MAIL => 'Отправка Email в очередь'
        ];

    }



    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tasks_logs';
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => false
            ],
        ];
    }



    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['task', 'processed_counter', 'success_counter', 'previous_log_offset', 'task_start_at', 'created_at', 'status', 'initiator'], 'integer'],
            [['data'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'        => 'ID',
            'task'      => 'задача',
            'processed_counter' => 'Processed Counter',
            'success_counter'   => 'Success Counter',
            'data'      => 'Data',
            'status'    => 'статус',
            'initiator' => 'Initiator',
            'previous_log_offset' => 'предыдущий запуск',
            'task_start_at'       => 'запуск',
            'created_at'          => 'создано',
        ];
    }
}
