<?php
return [
    'frontend-version'      => '1.0.10.4',
    'backend-version'       => '1.0.10.8', // будем бэк отдельно нумеровать

    'domain'                => 'http://yii-startup-kit.loc', // без слеша в конце
    'email'                 => 'site@zakupator.org',
    'robots'                => (YII_ENV == 'dev') ? 'none' : 'all', // содержимое для метатега с роботами. Есть еще условие в лейауте
    'expireRecovery'        => 86400,
    'loginDuration'         => 3600 * 24 * 30,
    'general_pagination'    => 10, // количество результатов на странице в общем случае. Там где было лень в отдельную настройку выносить

    'interkassa' => [
        'id'   => 'SET_DATA',
        'sign' => 'SET_DATA',
    ],

    'webMoney'   => [
        'purse'      => 'SET_DATA',
        'secret_key' => 'SET_DATA'
    ],
    'SEO'        => [
        'description' => '',
        'keywords'    => ''
    ],

    'walletOne'  => [
        'url'           => 'https://wl.walletone.com/checkout/checkout/Index',
        'auto_location' => '0',
        'currency_id'   => '643',
        'merchant_id'   => 'SET_DATA',
        'signature'     => 'SET_DATA',
    ],

    'anticaptcha' => [
        'services' => 'anti-captcha',
        'api_key'  => 'SET_DATA'
    ],
    'recaptcha' => [
        'key'        => '6LeKc2QUAAAAAMwkCBTNtudtPFjMkWAC1578mlhQ',
        'secret_key' => '6LeKc2QUAAAAANbcweI8l-tSCoD8w4u2YfoOCoW5'
    ],

    'sendPulse' => [
        'smtp' => [
            'public_key' => 'SET_DATA'
        ]
    ],
    'generalSettings' => false,

    'show_top_menu' => true, // показывать или нет верхнее меню в морде сайта. Скрывается в лендинге обычно
    'show_site_description' => false, // показывать или нет дескрипшн сайта. Больше для лендингов заточено.

    'initData' => [
        // данные начального пользователя, если пользователей еще нет.
        'adminName'  => 'Admin',
        'adminPass'  => '123123',
        'adminEmail' => 'admin@gmail.com'
    ]
];
