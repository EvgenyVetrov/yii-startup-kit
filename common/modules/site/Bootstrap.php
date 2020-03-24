<?php

namespace modules\site;

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
            $rules['']               = 'site/default/index';
            $rules['opportunities']  = 'site/default/opportunities';
            $rules['restrictions']   = 'site/default/restrictions';
            $rules['roadmap']        = 'site/default/roadmap';
            $rules['about']          = 'site/default/about';
            $rules['support-us']     = 'site/default/support-us';
            $rules['error']          = 'site/default/error';
            $rules['policy']         = 'site/default/policy';
            $rules['intro']          = 'site/default/intro';
            $app->urlManager->addRules($rules, false);
        }
    }


}