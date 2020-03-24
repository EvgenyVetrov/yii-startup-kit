<?php

namespace common\components;

use modules\main\components\TaskLog;
use modules\main\models\TasksLogs;
use yii;
use yii\base\ErrorException;

/**
 * Class SendEmail
 * @package common\components
 */
class SendMail extends yii\base\Model {
    /**
     * Название функции воркера
     */
    const WORKER_FUNCTION = 'send-email';
    /**
     * Низкий приоритет
     */
    const PRIORITY_LOW = 'low';
    /**
     * Высокий приоритет
     */
    const PRIORITY_HIGHT = 'hight';
    /**
     * Кому
     * @var
     */
    public $to;
    /**
     * Тема
     * @var
     */
    public $subject;
    /**
     * Html сообщения
     * @var
     */
    public $html;
    /**
     * Текст сообщения
     * @var
     */
    public $text;

    /**
     * Отправляем письмо
     * @param string $priority
     */
    public function send($priority = self::PRIORITY_HIGHT)
    {
        $servers = Yii::$app->params['gearman']['servers']['master'];
        if (!class_exists('\GearmanClient')) {
            $data = 'GearmanClient не найден. Нужно установить на сервер. Письмо не доставлено на адрес '. $this->to .'.  Код ошибки = send_mail_56';
            TaskLog::log(TasksLogs::TASK_SEND_MAIL, 1, 0, $data, 0, 0, TasksLogs::STATUS_FAIL);
            return false;
        }
        $client = new \GearmanClient();

        $client->addServers($servers);

        if ($priority == self::PRIORITY_HIGHT){
            $client->doHighBackground(self::WORKER_FUNCTION, $this->getData());
        }else{
            $client->doLowBackground(self::WORKER_FUNCTION, $this->getData());
        }
    }

    /**
     * Получаем данные для отправки задачи на воркер
     * @return array
     */
    protected function getData()
    {
        $data = [
            'to'      => $this->to,
            'html'    => $this->html,
            'text'    => $this->text,
            'subject' => $this->subject,
        ];

        return json_encode($data);
    }
}