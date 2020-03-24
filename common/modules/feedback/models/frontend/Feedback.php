<?php
/**
 * Created by PhpStorm.
 * User: vetrov
 * Date: 15.07.2018
 * Time: 23:11
 */

namespace modules\feedback\models\frontend;

use Yii;
use modules\feedback\models\BaseFeedback;

class Feedback extends BaseFeedback
{
    /**
     * Переопределяем загрузку объекта данными.
     * Дополняем загрузку очисткой данных
     *
     * @param array $data
     * @param null $formName
     * @return bool
     */
    public function load($data, $formName = null)
    {
        $result = parent::load($data, $formName);

        if (!Yii::$app->user->isGuest) {
            $this->user_id = Yii::$app->user->identity->id;
            $this->org_id  = Yii::$app->user->identity->current_organisation;
        }
        $this->type       = (int) $this->type;
        $this->object     = (int) $this->object;
        $this->object_id  = (int) $this->object_id;
        $this->user_agent = Yii::$app->request->userAgent;
        $this->ip         = Yii::$app->request->userIP;
        $this->text       = Yii::$app->formatter->clearData($this->text);
        $this->clearDeviceInfo(); // очистка всех параметров вынесена отдельно для чистоты

        return $result;
    }



    /**
     * Очищает каждый элемент объекта от возможных sql иъекций и подобного
     * Результат записывает в то-же свойство
     */
    private function clearDeviceInfo()
    {
        $this->device_info = Yii::$app->formatter->clearData($this->device_info, 'json');

        $deviceInfo      =  json_decode($this->device_info, true);
        $clearDeviceInfo = [];
        foreach($deviceInfo as $param => $value) {
            $clearDeviceInfo[$param] = Yii::$app->formatter->clearData($value, 'htmlspecialchars');
        }

        $this->device_info = json_encode($clearDeviceInfo);
    }
}