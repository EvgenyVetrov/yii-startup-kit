<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'frontend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'frontend\controllers',
    'language' => 'ru',
    'bootstrap' => [
        'log',
        'modules\main\Bootstrap',
        'modules\site\Bootstrap',
        'modules\blog\Bootstrap',
        'modules\users\Bootstrap',
        'modules\tender\Bootstrap',
        'modules\offers\Bootstrap',
        'modules\feedback\Bootstrap',
        'modules\organisations\Bootstrap',
    ],
    'modules' => [
        'main'   => ['class' => 'modules\main\Module'],
        'site'    => ['class' => 'modules\site\Module'],
        'blog'    => ['class' => 'modules\blog\Module'],
        'users'    => ['class' => 'modules\users\Module'],
        'tender'    => ['class' => 'modules\tender\Module'],
        'offers'     => ['class' => 'modules\offers\Module'],
        'markdown'    => ['class' => 'kartik\markdown\Module'],
        'feedback'     => ['class' => 'modules\feedback\Module'],
        'organisations' => ['class' => 'modules\organisations\Module'],
    ],
    'components' => [
        'view' => [
            'theme' => 'themes\material\Theme'
        ],
        'request' => [
            'baseUrl' => '',
            'enableCsrfCookie' => false
        ],
        'user' => [
            'identityClass'   => 'modules\users\models\frontend\Users',
            'enableAutoLogin' => true,
            'loginUrl' => ['/users/default/login']
        ],
        'errorHandler' => [
            'errorAction' => 'main/default/error',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class'    => 'yii\log\DbTarget',
                    'levels'   => ['error', 'warning'],
                    'logTable' => '{{%app_log}}',
                    'except'   => [
                        'yii\db\Command*',
                        'yii\db\Connection*',
                        'yii\web\HttpException:404'
                    ],
                    'prefix' => function ($message) {
                        return '[' . Yii::$app->user->id . ']';
                    }
                ],
            ],
        ],
        'urlManager' => [
            'rules'         => [],
            'enablePrettyUrl' => true,
            'showScriptName'    => false,
            'enableStrictParsing' => true,
        ],
        'reCaptcha' => [
            'name' => 'reCaptcha',
            'class' => 'himiklab\yii2\recaptcha\ReCaptcha',
            'siteKey' => $params['recaptcha']['key'],
            'secret' => $params['recaptcha']['secret_key'],
        ],
        /*'assetManager' => [
            'bundles' => [
                'yii\bootstrap\BootstrapAsset' => [
                    //'css' => []
                ]
            ]
        ],*/
    ],
    'params' => $params,

    'as access' => [
        'class' => 'yii\filters\AccessControl',
        'rules' => [
            [
                'allow'       => true,
                'actions'     => ['view'],
                'controllers' => ['tender/tenders'],
                'roles'       => ['?', '@'],
            ],
            [
                'allow'       => true,
                //'actions'     => ['index', 'opportunities', 'restrictions', 'policy', 'roadmap', 'support-us', 'about', 'intro'],
                'controllers' => ['site/default'],
                'roles'       => ['?', '@'],
            ],
            [
                'allow'       => true,
                'actions'     => ['view'],
                'controllers' => ['tender/tenders'],
                'roles'       => ['?', '@'],
            ],
            [
                'allow'       => true,
                //'actions'     => ['index', 'opportunities', 'restrictions', 'policy', 'roadmap', 'support-us', 'about', 'intro'],
                'controllers' => ['blog/posts'],
                'roles'       => ['?', '@'],
            ],
            [
                'allow'       => true,
                'actions'     => [
                    'login',
                    'registration',
                    'password-recovery',
                    'set-password',
                    'activate',
                    'unsubscribe-news',
                    'unsubscribe-notifications'
                ],
                'controllers' => ['users/default'],
                'roles'       => ['?'],
            ],
            [
                'allow'       => false,
                'actions'     => ['login', 'registration', 'password-recovery', 'set-password'],
                'controllers' => ['users/default'],
                'roles'       => ['@'],
            ],
            [
                'allow'       => true,
                'actions'     => ['cabinet'],
                'controllers' => ['tender/default'],
                'roles'       => ['@'],
            ],
            [
                'allow'       => true,
                'roles'       => ['@'],
            ],
            [
                'allow'       => true,
                'actions'     => ['error'],
                'controllers' => ['main/default'],
            ],
            [
                'allow'       => true,
                'controllers' => ['debug/default'],
                'roles'       => ['?'],
            ],
        ],
    ],
];
