<?php

namespace console\workers;

use yii;
use common\components\SendPulseSmtpApi;

/**
 * Class SendMail
 * @package console\models
 */
class SendMail {
    /**
     * @param $job \GearmanJob
     */
    public function run($job)
    {
        $data = json_decode($job->workload(), true);

        $send = $this->send($data);
        Yii::info('run($job) answer: ' . json_encode($send), 'worker_sendMail');

        if (isset($send['error']) && $send['error'] == 0){
            echo "\tOk\n";
            Yii::info('run($job) OK: ', 'worker_sendMail');
        }else if (isset($send['text'])){
            echo "\tError: " . $send['text'] . "\n";
            Yii::error($send['text'], 'worker_sendMail');
        }else{
            echo "\tError: not error text\n";
            Yii::error('Not error text', 'worker_sendMail');
        }
    }

    /**
     * @param $data
     * @return mixed
     */
    public function send($data)
    {
        $to      = $data['to'];
        $html    = $data['html'];
        $text    = $data['text'];
        $subject = $data['subject'];

        if (!\Yii::$app->mailer->transport->isStarted()) {
            \Yii::$app->mailer->transport->start();
        }

        try{
            $result = Yii::$app->mailer->compose()
                ->setFrom(Yii::$app->params['site_email'])
                ->setTo($to)
                ->setSubject($subject)
                ->setTextBody($text)
                ->setHtmlBody($html)
                ->send();

            Yii::info('try send: ' . json_encode($result), 'worker_sendMail');
        }
            //Перехватываем (catch) исключение, если что-то идет не так.
        catch (\Exception $ex) {
            sleep(5);
            Yii::info('Отправка почты после try-catch: "' . $subject . '" to "' . $to . '"', 'worker_sendMail');
            Yii::info(json_encode($ex));
            $result = Yii::$app->mailer->compose()
                ->setFrom(Yii::$app->params['site_email'])
                ->setTo($to)
                ->setSubject($subject)
                ->setTextBody($text)
                ->setHtmlBody($html)
                ->send();

            Yii::info($result, 'worker_sendMail');
        }

        \Yii::$app->mailer->getTransport()->stop();

        return $result;

        //$api = new SendPulseSmtpApi(Yii::$app->params['sendPulse']['smtp']['public_key']);

        /*$data = [
            'html'      => $html,
            'text'      => $text,
            'encoding'  => Yii::$app->charset,
            'subject'   => $subject,
            'from'      => [
                'name'  => Yii::$app->name,
                'email' => Yii::$app->params['email'],
            ],
            'to' => [
                [
                    'email' => $to,
                ]
            ],
        ];*/

        //return $api->send_email($data);
    }
}