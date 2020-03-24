<?php
return [
    'name' => 'yii-startup-kit',
    'charset' => 'UTF-8',
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'defaultRoute' => 'main/default',
    'language' => 'ru',
    'timeZone' => 'Europe/Minsk',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'components' => [
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName'  => false,
            'rules'           => [],
        ],
        'assetManager' => [
            'basePath'       => '@webroot/assets',
            'baseUrl'        => '@web/assets',
            'linkAssets'     => true
        ],
        'formatter' => [
            'class'          => 'common\components\Formatter',
            'dateFormat'     => 'php:d M Y',
            'datetimeFormat' => 'php:d M H:i:s',
            'timeFormat'     => 'php:H:i:s',
        ],
        'authManager' => [
            'class'          => 'yii\rbac\PhpManager',
            'defaultRoles'   => ['user'],
            'itemFile'       => '@modules/rbac/data/items.php',
            'assignmentFile' => '@modules/rbac/data/assignments.php',
            'ruleFile'       => '@modules/rbac/data/rules.php',
        ],
        'session' => [
            'class'         => 'yii\web\DbSession',
            'sessionTable'  => 'app_session',
            'writeCallback' => function ($session) {
                return [
                    'user_id'     => Yii::$app->user->id,
                    'ip'          => Yii::$app->request->userIP,
                    'ua'          => Yii::$app->request->userAgent,
                    'last_action' => time(),
                ];
            },
        ],
        'i18n' => [
            'translations' => [
                'app*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@common/messages'
                ],
            ],
        ]
    ],
];
