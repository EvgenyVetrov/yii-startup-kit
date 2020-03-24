<?php

use yii\helpers\Url;

/**
 * Created by PhpStorm.
 * User: evgeny
 * Date: 11.11.17
 * Time: 23:24
 */

?>

<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <?php if (Yii::$app->user->can('users-view')): ?>
                <li id="place-users">
                    <a href="<?= Url::to(['/users/default/index']) ?>">
                        <i class="fa fa-users"></i>
                        <span>Пользователи</span>
                    </a>
                </li>
                <li id="place-profiles">
                    <a href="<?= Url::to(['/users/profiles/index']) ?>">
                        <i class="fa fa-user-o"></i>
                        <span>Профили</span>
                    </a>
                </li>
            <?php endif ?>
            <?php if (Yii::$app->user->can('organisations-view')): ?>
                <li id="place-organisations">
                    <a href="<?= Url::to(['/organisations/default/index']) ?>">
                        <i class="fa fa-building-o"></i>
                        <span>Организации</span>
                    </a>
                </li>
            <?php endif ?>
            <?php if (Yii::$app->user->can('users-log')): ?>
                <li id="place-users-log">
                    <a href="<?= Url::to(['/users/log/index']) ?>">
                        <i class="fa fa-retweet"></i>
                        <span>Журнал действий</span>
                    </a>
                </li>
            <?php endif ?>
            <?php if (Yii::$app->user->can('rbac') || Yii::$app->user->can('task-manager')): ?>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-gear"></i>
                        <span>Инструменты</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li id="place-rbac">
                            <a href="<?= Url::to(['/rbac/default/index']) ?>">
                                <i class="fa fa-circle-o"></i>
                                <span>Права доступа</span>
                            </a>
                        </li>
                        <li id="place-rules">
                            <a href="<?= Url::to(['/rbac/rules/index']) ?>">
                                <i class="fa fa-circle-o"></i>
                                <span>Правила доступа</span>
                            </a>
                        </li>
                        <li id="place-roles">
                            <a href="<?= Url::to(['/rbac/roles/index']) ?>">
                                <i class="fa fa-circle-o"></i>
                                <span>Роли пользователей</span>
                            </a>
                        </li>
                        <li id="place-gii">
                            <a href="<?= Url::to(['/gii']) ?>" target="_blank">
                                <i class="fa fa-circle-o"></i>
                                <span>Gii</span>
                            </a>
                        </li>
                        <li id="place-phpinfo">
                            <a href="<?= Url::to(['/main/main/phpinfo']) ?>" >
                                <i class="fa fa-circle-o"></i>
                                <span>phpInfo()</span>
                            </a>
                        </li>
                        <?php if (Yii::$app->user->can('task-manager')): ?>
                        <li id="place-task-manager">
                            <a href="<?= Url::to(['/main/task-manager/index']) ?>" >
                                <i class="fa fa-circle-o"></i>
                                <span>Менеджер задач</span>
                            </a>
                        </li>
                        <li id="place-tasks-logs">
                            <a href="<?= Url::to(['/main/tasks-logs/index']) ?>" >
                                <i class="fa fa-list"></i>
                                <span>Логи задач</span>
                            </a>
                        </li>
                        <?php endif; ?>
                        <li id="place-general-settings">
                            <a href="<?= Url::to(['/main/settings/index']) ?>" >
                                <i class="fa fa-cogs"></i>
                                <span>Общие настройки</span>
                            </a>
                        </li>
                        <li id="place-sitemap">
                            <a href="<?= Url::to(['/sitemap/default/dashboard']) ?>" >
                                <i class="fa fa-circle-o"></i>
                                <span>Sitemap</span>
                            </a>
                        </li>
                    </ul>
                </li>
            <?php endif ?>
            <?php if (Yii::$app->user->can('libraries')): ?>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-database"></i>
                        <span>Библиотеки</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li id="place-countries">
                            <a href="<?= Url::to(['/main/countries/index']) ?>">
                                <i class="fa fa-map-marker"></i>
                                <span>Страны</span>
                            </a>
                        </li>
                        <li id="place-districts">
                            <a href="<?= Url::to(['/main/districts/index']) ?>">
                                <i class="fa fa-map-marker"></i>
                                <span>Районы</span>
                            </a>
                        </li>
                        <li id="place-cities">
                            <a href="<?= Url::to(['/main/cities/index']) ?>">
                                <i class="fa fa-map-marker"></i>
                                <span>Населенные пункты</span>
                            </a>
                        </li>
                        <?php if (Yii::$app->user->can('categories-view')): ?>
                            <li id="place-categories">
                                <a href="<?= Url::to(['/tender/categories/index']) ?>">
                                    <i class="fa fa-sitemap"></i>
                                    <span>Категории</span>
                                </a>
                            </li>
                        <?php endif ?>
                    </ul>
                </li>
            <?php endif ?>
            <?php if (Yii::$app->user->can('tenders-forms') OR Yii::$app->user->can('tenders-list')): ?>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-shopping-cart"></i>
                        <span>Закупки</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <?php if (Yii::$app->user->can('tenders-forms')): ?>
                            <li id="place-tenders-forms">
                                <a href="<?= Url::to(['/tender/tenders-forms/index']) ?>">
                                    <i class="fa fa-cog"></i>
                                    <span>Формы закупок</span>
                                </a>
                            </li>
                            <li id="place-tenders-fields">
                                <a href="<?= Url::to(['/tender/tenders-fields/index']) ?>">
                                    <i class="fa fa-cog"></i>
                                    <span>Поля форм</span>
                                </a>
                            </li>
                        <?php endif; ?>
                        <?php if (Yii::$app->user->can('tenders-list')): ?>
                            <li id="place-tenders-list">
                                <a href="<?= Url::to(['/tender/tenders/index']) ?>">
                                    <i class="fa fa-list"></i>
                                    <span>Список закупок</span>
                                </a>
                            </li>
                        <?php endif; ?>
                        <li id="place-rejected-tenders">
                            <a href="<?= Url::to(['/tender/rejected-tenders/index']) ?>">
                                <i class="fa fa-times-circle"></i>
                                <span>Отклонённые</span>
                            </a>
                        </li>
                        <li id="place-tender-comments">
                            <a href="<?= Url::to(['/tender/tender-comments/index']) ?>">
                                <i class="fa fa-comment"></i>
                                <span>Комментарии</span>
                            </a>
                        </li>
                        <li id="place-favorites-tenders">
                            <a href="<?= Url::to(['/tender/favorites-tenders/index']) ?>">
                                <i class="fa fa-star"></i>
                                <span>Избранное</span>
                            </a>
                        </li>
                        <?php if (Yii::$app->user->can('tender-subscriptions')): ?>
                            <li id="place-tender-subscriptions">
                                <a href="<?= Url::to(['/tender/subscriptions/index']) ?>">
                                    <i class="fa fa-bell"></i>
                                    <span>Подписки на закупки</span>
                                </a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </li>
            <?php endif ?>
            <?php if (Yii::$app->user->can('offers')): ?>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-bullhorn"></i>
                        <span>Предложения</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <?php if (Yii::$app->user->can('offers')): ?>
                            <li id="place-offers">
                                <a href="<?= Url::to(['/offers/default/index']) ?>">
                                    <i class="fa fa-list"></i>
                                    <span>Список предложений</span>
                                </a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </li>
            <?php endif ?>
            <?php if (Yii::$app->user->can('moderator')): ?>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-shield"></i>
                        <span>Модерирование</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <?php if (Yii::$app->user->can('moderator')): ?>
                            <li id="place-feedback">
                                <a href="<?= Url::to(['/feedback/default/index']) ?>">
                                    <i class="fa fa-commenting"></i>
                                    <span>Feedback</span>
                                </a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </li>
            <?php endif ?>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-newspaper-o"></i>
                    <span>Блог</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li id="place-blog-posts">
                        <a href="<?= Url::to(['/blog/posts/index']) ?>">
                            <i class="fa fa-file-text-o"></i>
                            <span>Статьи</span>
                        </a>
                    </li>
                    <li id="place-blog-categories">
                        <a href="<?= Url::to(['/blog/categories/index']) ?>">
                            <i class="fa fa-sitemap"></i>
                            <span>Категории</span>
                        </a>
                    </li>
                    <li id="place-blog-tags">
                        <a href="<?= Url::to(['/blog/tags/index']) ?>">
                            <i class="fa fa-tags"></i>
                            <span>Теги</span>
                        </a>
                    </li>
                    <li id="place-general-settings-blog">
                        <a href="<?= Url::to(['/main/settings/module/blog']) ?>">
                            <i class="fa fa-cogs"></i>
                            <span>Настройки блога</span>
                        </a>
                    </li>

                </ul>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
