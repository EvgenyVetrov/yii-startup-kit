<?php
/**
 * Created by PhpStorm.
 * User: evetrov
 * Date: 11.06.20
 * Time: 12:36
 */

namespace modules\site\components;

use modules\site\models\BasePages;
use yii\web\UrlRule as Rule;

class UrlRule extends Rule
{
    public $pattern = '';
    public $route = 'site/default/view';

    public function createUrl($manager, $route, $params)
    {
        if ($route === 'pages/default/view' && isset($params['id'])) {
            return $params['id'];
        }
        return false;
    }


    /**
     * @inheritdoc
     */
    public function parseRequest($manager, $request)
    {
        $pathInfo = preg_replace('#^(.*?)/$#', '$1', $request->pathInfo);
        if (BasePages::find()->where([
            'location' => $pathInfo,
            'status'   => BasePages::STATUS_ACTIVE,
            'type'     => BasePages::TYPE_VIRTUAL
        ])->count()) {
            return [
                $this->route,
                [
                    'id' => $pathInfo
                ]
            ];
        }
        return false;
    }
}