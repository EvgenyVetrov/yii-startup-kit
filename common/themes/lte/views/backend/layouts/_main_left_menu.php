<?php

use yii\helpers\Url;

/**
 * Created by PhpStorm.
 * User: evgeny
 * Date: 11.11.17
 * Time: 23:24
 */

?>

<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?= Url::to(['/']) ?>" class="brand-link">
        <span class="brand-text font-weight-light"><?= Yii::$app->name ?></span>
    </a>


    <!-- sidebar: style can be found in sidebar.less -->
    <div class="sidebar">

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <?php if (Yii::$app->user->can('users-view')): ?>
                    <li class="nav-item" id="place-users">
                        <a href="<?= Url::to(['/users/default/index']) ?>" class="nav-link">
                            <i class="nav-icon fas fa-users"></i>
                            <p>Пользователи</p>
                        </a>
                    </li>
                <?php endif ?>
                <?php if (Yii::$app->user->can('users-log')): ?>
                    <li class="nav-item" id="place-users-log">
                        <a href="<?= Url::to(['/users/log/index']) ?>" class="nav-link">
                            <i class="nav-icon fas fa-retweet"></i>
                            <p>Журнал действий</p>
                        </a>
                    </li>
                <?php endif ?>

                <?php if (Yii::$app->user->can('pages')): ?>
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-sitemap"></i>
                            <p>Страницы сайта</p>
                            <i class="right fas fa-angle-left"></i>
                        </a>
                        <ul class="nav nav-treeview ">
                            <li id="place-site-pages" class="nav-item">
                                <a href="<?= Url::to(['/site/pages/index']) ?>"  class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Страницы</p>
                                </a>
                            </li>
                            <li id="place-site-pages-blocks" class="nav-item">
                                <a href="<?= Url::to(['/site/pages-blocks/index']) ?>"  class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Отдельные блоки</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                <?php endif ?>


                <?php if (Yii::$app->user->can('rbac') || Yii::$app->user->can('task-manager')): ?>
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-cog"></i>
                            <p>Инструменты</p>
                            <i class="right fas fa-angle-left"></i>
                        </a>
                        <ul class="nav nav-treeview ">
                            <li id="place-rbac" class="nav-item">
                                <a href="<?= Url::to(['/rbac/default/index']) ?>" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Права доступа</p>
                                </a>
                            </li>
                            <li id="place-rules" class="nav-item">
                                <a href="<?= Url::to(['/rbac/rules/index']) ?>"  class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Правила доступа</p>
                                </a>
                            </li>
                            <li id="place-roles" class="nav-item">
                                <a href="<?= Url::to(['/rbac/roles/index']) ?>"  class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Роли пользователей</p>
                                </a>
                            </li>
                            <li id="place-gii" class="nav-item">
                                <a href="<?= Url::to(['/gii']) ?>"  class="nav-link" target="_blank">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Gii</p>
                                </a>
                            </li>
                            <li id="place-phpinfo" class="nav-item">
                                <a href="<?= Url::to(['/main/main/phpinfo']) ?>"  class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>phpInfo()</p>
                                </a>
                            </li>
                            <?php if (Yii::$app->user->can('task-manager')): ?>
                                <li id="place-task-manager" class="nav-item">
                                    <a href="<?= Url::to(['/main/task-manager/index']) ?>"   class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Менеджер задач</p>
                                    </a>
                                </li>
                                <li id="place-tasks-logs" class="nav-item">
                                    <a href="<?= Url::to(['/main/tasks-logs/index']) ?>"  class="nav-link">
                                        <i class="nav-icon fa fa-list"></i>
                                        <p>Логи задач</p>
                                    </a>
                                </li>
                            <?php endif; ?>
                            <li id="place-general-settings" class="nav-item">
                                <a href="<?= Url::to(['/main/settings/index']) ?>"  class="nav-link">
                                    <i class="nav-icon fa fa-cogs"></i>
                                    <p>Общие настройки</p>
                                </a>
                            </li>
                            <li id="place-sitemap" class="nav-item">
                                <a href="<?= Url::to(['/sitemap/default/dashboard']) ?>"  class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Sitemap</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                <?php endif ?>
                <?php if (Yii::$app->user->can('libraries')): ?>
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-database"></i>
                            <p>Библиотеки</p>
                            <i class="right fas fa-angle-left"></i>
                        </a>
                        <ul class="nav nav-treeview ">
                            <li id="place-countries" class="nav-item">
                                <a href="<?= Url::to(['/main/countries/index']) ?>"  class="nav-link">
                                    <i class="nav-icon fas fa-map-marker"></i>
                                    <p>Страны</p>
                                </a>
                            </li>
                            <li id="place-districts" class="nav-item">
                                <a href="<?= Url::to(['/main/districts/index']) ?>"  class="nav-link">
                                    <i class="nav-icon fa fa-map-marker"></i>
                                    <p>Районы</p>
                                </a>
                            </li>
                            <li id="place-cities" class="nav-item">
                                <a href="<?= Url::to(['/main/cities/index']) ?>"  class="nav-link">
                                    <i class="nav-icon fas fa-map-marker"></i>
                                    <p>Населенные пункты</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                <?php endif ?>
                <?php if (Yii::$app->user->can('moderator')): ?>
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-check"></i>
                            <p>Модерирование</p>
                            <i class="right fas fa-angle-left"></i>
                        </a>
                        <ul class="nav nav-treeview">
                            <?php if (Yii::$app->user->can('moderator')): ?>
                                <li id="place-feedback" class="nav-item">
                                    <a href="<?= Url::to(['/feedback/default/index']) ?>"  class="nav-link">
                                        <i class="nav-icon fa fa-commenting"></i>
                                        <p>Feedback</p>
                                    </a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </li>
                <?php endif ?>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-newspaper"></i>
                        <p>Блог</p>
                        <i class="right fas fa-angle-left"></i>
                    </a>
                    <ul class="nav nav-treeview ">
                        <li id="place-blog-posts" class="nav-item">
                            <a href="<?= Url::to(['/blog/posts/index']) ?>" class="nav-link">
                                <i class="nav-icon far fa-file-alt"></i>
                                <p>Статьи</p>
                            </a>
                        </li>
                        <li id="place-blog-categories" class="nav-item">
                            <a href="<?= Url::to(['/blog/categories/index']) ?>" class="nav-link">
                                <i class="nav-icon fas fa-sitemap"></i>
                                <p>Категории</p>
                            </a>
                        </li>
                        <li id="place-blog-tags" class="nav-item">
                            <a href="<?= Url::to(['/blog/tags/index']) ?>" class="nav-link">
                                <i class="nav-icon fas fa-tags"></i>
                                <p>Теги</p>
                            </a>
                        </li>
                        <li id="place-general-settings-blog" class="nav-item">
                            <a href="<?= Url::to(['/main/settings/module/blog']) ?>" class="nav-link">
                                <i class="nav-icon fas fa-cogs"></i>
                                <p>Настройки блога</p>
                            </a>
                        </li>

                    </ul>
                </li>
            </ul>
        </nav>

    </div>
    <!-- /.sidebar -->
</aside>
