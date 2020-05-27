<?php
return [
    'admin' => [
        'type' => 1,
        'description' => 'Администратор',
        'ruleName' => 'Author',
        'children' => [
            'rbac',
            'backend-access',
            'users-log',
            'users-view',
            'users-crud',
            'payment',
            'users-auth',
            'support',
            'libraries',
            'moderator',
            'task-manager',
            'blog-crud',
            'pages',
        ],
    ],
    'rbac' => [
        'type' => 2,
        'description' => 'RBAC: Управление и назначение прав доступа',
    ],
    'backend-access' => [
        'type' => 2,
        'description' => 'Админ-панель: доступ',
    ],
    'users-log' => [
        'type' => 2,
        'description' => 'Журналу действий: просмотр',
    ],
    'users-view' => [
        'type' => 2,
        'description' => 'Пользователи: просмотр',
    ],
    'users-crud' => [
        'type' => 2,
        'description' => 'Пользователи: crud',
    ],
    'payment' => [
        'type' => 2,
        'description' => 'Финансы: crud',
    ],
    'users-auth' => [
        'type' => 2,
        'description' => 'Пользователи: авторизация',
    ],
    'support' => [
        'type' => 2,
        'description' => 'Поддержка: CRUD',
    ],
    'libraries' => [
        'type' => 2,
        'description' => 'Доступ к библиотекам',
    ],
    'moderator' => [
        'type' => 2,
        'description' => 'Модерирование',
    ],
    'task-manager' => [
        'type' => 2,
        'description' => 'Менеджер задач (просмотр и остановка воркеров)',
    ],
    'blog-crud' => [
        'type' => 2,
        'description' => 'Блог: crud',
    ],
    'pages' => [
        'type' => 2,
        'description' => 'CRUD страниц сайта и блоков',
    ],
];
