<?php

namespace console\controllers;

use yii;
use GearmanWorker;
use yii\console\Controller;
use console\workers\SendMail;
use console\workers\SendVkMessage;
use modules\main\models\backend\TaskManager;

/**
 * Class WorkersController
 * @package console\controllers
 */
class WorkersController extends Controller {
    /**
     * Отправка писем на почту
     */
    public function actionSendEmail()
    {
        $servers = Yii::$app->params['gearman']['servers']['master'];

        $worker = new GearmanWorker();
        $worker->addServers($servers);
        $worker->addFunction('send-email', [new SendMail(), 'run']);

        $i = 0;
        while ($worker->work()){
            //echo ++$i . ') ' . Yii::$app->formatter->asDatetime(time()) . PHP_EOL;
            sleep(2); // 2 сек
        }
    }


    /**
     * Экшн перезапуска воркера отправки емайла
     * запускается каждую минуту по cron
     */
    public function actionCheckEmailWorker()
    {
        sleep(2);
        $model = new TaskManager();
        $result = $model->status();

        if (isset($result['send-email']) AND $result['send-email']['capable_workers'] >= 1) {
            echo 'send-email ok'.PHP_EOL;
        } else {
            $workingDirectory = explode('console', __DIR__)[0];
            $command = 'php '. $workingDirectory .'yii workers/send-email &';
            Yii::error('В очередной раз сбросилось SMTP соединение. Перезапускаем воркер send-mail: '. $command, 'worker_sendMail');
            $reinitResult = shell_exec($command);

            // он уже не выведется, но на всякий случай
            //$logMessage = 'В очередной раз сбросилось SMTP соединение. Перезапускаем воркер send-mail: ' . trim($reinitResult);
            //echo $logMessage . PHP_EOL;
        }
    }



    /**
     * Отправка писем VK
     */
    public function actionSendNotification()
    {
        $servers = Yii::$app->params['gearman']['servers']['master'];

        $worker = new GearmanWorker();
        $worker->addServers($servers);
        $worker->addFunction('send-notification', [new SendVkMessage(), 'run']);

        $i = 0;
        while ($worker->work()){
            echo ++$i . ') ' . Yii::$app->formatter->asDatetime(time()) . PHP_EOL;
        }
    }
}