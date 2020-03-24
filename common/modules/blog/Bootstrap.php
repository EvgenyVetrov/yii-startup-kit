<?php

namespace modules\blog;

use yii\base\BootstrapInterface;

/**
 * Class Bootstrap
 * @package modules\blog
 */
class Bootstrap implements BootstrapInterface
{
    /**
     * @inheritdoc
     */
    public function bootstrap($app)
    {
        if ($app->id === 'frontend'){
            $rules['blog']                 = 'blog/posts/index';
            $rules['blog/post/<id:(\d+)>'] = 'blog/posts/view';
            $rules['/p/<id:(\d+)>'] = 'blog/posts/view';
            /*$rules[] = [
                'pattern' => 'blog/post/<id:(\d+)>',
                'route'   => 'blog/posts/view'
            ];*/

            $app->urlManager->addRules($rules, false);
        }

    }
}