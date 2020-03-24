<?php

namespace modules\feedback\models\backend;


use modules\feedback\models\BaseFeedback;

/**
 * Class Feedback
 * @package modules\feedback\models\backend
 */
class Feedback extends BaseFeedback
{

    /**
     * Простой счетчик непрочитанных фидбэков
     * @return int|string
     */
    public static function countNewFeedbacks() {
        return self::find()->where(['status' => self::STATUS_NEW])->count();
    }

}