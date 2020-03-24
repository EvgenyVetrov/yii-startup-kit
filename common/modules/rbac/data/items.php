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
            'organisations-view',
            'organisations-crud',
            'libraries',
            'categories-crud',
            'categories-view',
            'tenders-forms',
            'tenders-list',
            'offers',
            'moderator',
            'task-manager',
            'blog-crud',
            'tender-subscriptions',
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
    'organisations-view' => [
        'type' => 2,
        'description' => 'Организации: просмотр',
    ],
    'organisations-crud' => [
        'type' => 2,
        'description' => 'Организации: CRUD',
    ],
    'libraries' => [
        'type' => 2,
        'description' => 'Доступ к библиотекам',
    ],
    'categories-crud' => [
        'type' => 2,
        'description' => 'Категории: CRUD',
    ],
    'categories-view' => [
        'type' => 2,
        'description' => 'Категории: просмотр',
    ],
    'tenders-forms' => [
        'type' => 2,
        'description' => 'Составление форм закупок',
    ],
    'tenders-list' => [
        'type' => 2,
        'description' => 'Доступ к закупкам',
    ],
    'offers' => [
        'type' => 2,
        'description' => 'Предложения: CRUD',
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
    'tender-subscriptions' => [
        'type' => 2,
        'description' => 'Подписки на закупки: crud',
    ],
];
