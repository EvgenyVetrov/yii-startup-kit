<?php

namespace modules\feedback;

use Yii;
use yii\base\BootstrapInterface;

/**
 * Class Bootstrap
 * @package modules\main
 */
class Bootstrap implements BootstrapInterface
{
    /**
     * @inheritdoc
     */
    public function bootstrap($app)
    {
        if ($app->id === 'frontend'){
            $rules['feedback/create'] = 'feedback/default/create';
            $app->urlManager->addRules($rules, false);
        }
    }


}