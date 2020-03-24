<?php

namespace modules\main\models\backend;

use yii;
use GearmanWorker;
use yii\base\Model;
use Net_Gearman_Manager;
use yii\web\ForbiddenHttpException;

/**
 * Class TaskManager
 * @package modules\main\models\backend
 */
class TaskManager extends Model {
    /**
     * @var array
     */
    public $servers = [];
    /**
     * @var array
     */
    public $errorServers = [];

    /**
     * @throws ForbiddenHttpException
     */
    public function init()
    {
        parent::init();

        if (isset(Yii::$app->params['gearman']['servers'])){
            $this->servers = Yii::$app->params['gearman']['servers'];
        }else{
            throw new ForbiddenHttpException('Не найдена конфигурация серверов.');
        }
    }

    /**
     * @param bool $function_id
     * @return array|mixed
     */
    public function status($function_id = false)
    {
        $data = [];

        foreach ($this->servers as $id => $address){
            try{
                $server   = new Net_Gearman_Manager($address);
                $statuses = $server->status();
                $server->disconnect();

                foreach ($statuses as $function => $status){
                    $data[$function] = [
                        'server'          => $id,
                        'function'        => $function,
                        'in_queue'        => $status['in_queue'],
                        'jobs_running'    => $status['jobs_running'],
                        'capable_workers' => $status['capable_workers'],
                    ];
                }
            }catch (\Exception $e){
                $this->errorServers[$id] = $e->getMessage();
            }
        }

        if ($function_id){
            return isset($data[$function_id]) ? $data[$function_id] : [];
        }

        return $data;
    }

    /**
     * Останавливаем все воркеры
     * @param $function
     * @throws ForbiddenHttpException
     */
    public function stopWorker($function)
    {
        $allFunctions = $this->status();
//        if (isset($allFunctions[$function]) === false){
//            throw new ForbiddenHttpException('Воркер не найден!');
//        }

        exec("ps ax | grep ". $function ." | awk '{print $1}' | xargs kill");
    }

    /**
     * Останавливаем воркеры которые висят в очереди
     * @param $function
     * @return int
     * @throws ForbiddenHttpException
     */
    public function stopWorkerEmpty($function)
    {
        $allFunctions = $this->status();
        if (isset($allFunctions[$function]) === false){
            throw new ForbiddenHttpException('Воркер не найден!');
        }

        $total  = 0;
        $client = new \GearmanClient();
        $client->addServers($this->servers['master']);

        do{
            $status = $this->status($function);
            $count  = isset($status['capable_workers'], $status['in_queue']) ?
                $status['capable_workers'] - $status['in_queue'] : 0;

            if ($count > 0){
                ++$total;
                $client->doBackground($function, json_encode([]));
                usleep(5000);
            }else{
                sleep(1);
            }
        }while($count > 0);

        return $total;
    }

    /**
     * @param $function
     * @return int
     * @throws ForbiddenHttpException
     */
    public function stopTask($function)
    {
        $allFunctions = $this->status();
        if (isset($allFunctions[$function]) === false){
            throw new ForbiddenHttpException('Воркер не найден!');
        }

        $total  = 0;
        $worker = new GearmanWorker();
        $worker->addServers($this->servers['master']);
        $worker->addFunction($function, function (){});

        do{
            $status = $this->status($function);
            $count  = isset($status['in_queue'], $status['jobs_running']) ?
                $status['in_queue'] - $status['jobs_running'] : 0;

            if ($count > 0){
                ++$total;
                $worker->work();
                usleep(5000);
            }
        }while($count > 0);

        return $total;
    }
}