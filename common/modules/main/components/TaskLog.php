<?php
/**
 * Created by PhpStorm.
 * User: vetrov
 * Date: 31.01.2020
 * Time: 10:46
 */

namespace modules\main\components;


use modules\main\models\TasksLogs;

class TaskLog
{
    /**
     * Получаем последний лог для конкретной задачи
     * @param int $task
     * @return array|TasksLogs|null|\yii\db\ActiveRecord
     */
    public static function getLastLog(int $task)
    {
        $log = TasksLogs::find()
            ->where(['task' => $task, 'status' => TasksLogs::STATUS_CORRECT])
            ->orderBy(['id' => SORT_DESC])
            ->asArray()
            ->one();

        return $log;
    }


    /**
     * Возвращает timestamp последнего запуска задачи
     *
     * @param int $task
     * @return int
     */
    public static function  getLastRunTimestamp(int $task)
    {
        $log = self::getLastLog($task);
        if (!$log) {
            return 0;
        }

        return (int) $log['task_start_at'];
    }



    /**
     * Метод создания новой записи логов
     *
     * @param $task
     * @param $processed_counter
     * @param $success_counter
     * @param $data
     * @param int $task_start_at
     * @param int $initiator
     */
    public static function log($task, $processed_counter, $success_counter, $data = null, $task_start_at = 0, $initiator = 0, $status = 0 )
    {
        if (is_array($data)) {
            $data = json_encode($data,  JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES );
        }
        $model = new TasksLogs([
            'task'              => $task,
            'processed_counter' => $processed_counter,
            'success_counter'   => $success_counter,
            'data'              => $data,
            'task_start_at'     => $task_start_at,
            'status'            => $status,
            'initiator'         => $initiator,
        ]);

        $model->save();
    }

}