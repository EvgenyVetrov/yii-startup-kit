<?php

namespace modules\main;

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
            //$rules['']                = 'main/default/index';
            $rules['error']            = 'main/default/error';
            $rules['content/policy']    = 'main/default/policy';
            $rules['content/offer']      = 'main/default/offer';
            $rules['/main/get-districts'] = 'main/default/get-districts';
            $rules['/main/get-cities'] = 'main/default/get-cities';
            $app->urlManager->addRules($rules, false);
        }

        if ($app->id === 'backend'){
            $rules['main/settings/module/<module_name:(.*)>']  = 'main/settings/module'; // настройки, принадлежащие конкретному модулю
            $app->urlManager->addRules($rules, false);
        }
    }
}