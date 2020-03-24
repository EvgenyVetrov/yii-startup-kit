<?php

use yii\helpers\Html;
/**
 * Файл бокового меню
 *
 * Date: 08.10.17
 * Time: 17:09
 */

$assetPath = Yii::$app->assetManager->getPublishedUrl(Yii::$app->params['assetPath']);
?>

<div class="sidebar" data-active-color="blue" data-background-color="black" data-image="<?= $assetPath ?>/img/sidebar-1.jpg">
    <!--
Tip 1: You can change the color of active element of the sidebar using: data-active-color="purple | blue | green | orange | red | rose"
Tip 2: you can also add an image using data-image tag
Tip 3: you can change the color of the sidebar with data-background-color="white | black"
-->
    <div class="logo">
        <a href="/" class="simple-text logo-mini">
            <img  height="40" src="/img/logo/zakupator-transparent-sign-mini.png" alt="Главная страница закупатор" title="на главную">
        </a>
        <a href="/" class="simple-text logo-normal">
            ZAKUPATOR <sup>.org</sup>
        </a>
    </div>
    <div class="sidebar-wrapper">
        <div class="user">
            <div class="photo">
                <img src="<?= $assetPath ?>/img/faces/avatar.jpg" />
            </div>
            <div class="info">
                <a data-toggle="collapse" href="#collapseExample" class="collapsed">
                            <span>
                                Гость 23460
                                <b class="caret"></b>
                            </span>
                </a>
                <div class="clearfix"></div>
                <div class="collapse" id="collapseExample">
                    <ul class="nav">
                        <?php if(Yii::$app->user->isGuest): ?>
                            <li id="place-recovery-password">
                                <?= Html::a('<span class="sidebar-mini"><i class="material-icons">fingerprint</i></span>
                                              <span class="sidebar-normal">Войти</span>', ['/login']); ?>
                            </li>
                            <li id="place-registration">
                                <?= Html::a('<span class="sidebar-mini"><i class="material-icons">person_add</i></span>
                                              <span class="sidebar-normal">Регистрация</span>', ['/registration']); ?>
                            </li>
                            <li id="place-recovery-password">
                                <?= Html::a('<span class="sidebar-mini"><i class="material-icons">lock_open</i></span>
                                              <span class="sidebar-normal">Восстановление пароля</span>', ['/password-recovery']); ?>
                            </li>
                        <?php endif; ?>
                        <?php if(!Yii::$app->user->isGuest): ?>
                            <li id="place-cabinet">
                                <?= Html::a('<span class="sidebar-mini"><i class="material-icons">dashboard</i></span>
                                              <span class="sidebar-normal">Рабочий кабинет</span>', ['/cabinet']); ?>
                            </li>
                            <li id="place-my-organisations">
                                <?= Html::a('<span class="sidebar-mini"><i class="material-icons">business</i></span>
                                              <span class="sidebar-normal">Мои организации</span>', ['/my-organisations']); ?>
                            </li>
                            <li id="place-profile">
                                <?= Html::a('<span class="sidebar-mini"><i class="material-icons">account_box</i></span>
                                              <span class="sidebar-normal">Мой профиль</span>', ['/profile']); ?>
                            </li>
                            <li id="place-settings">
                                <?= Html::a('<span class="sidebar-mini"><i class="material-icons">settings</i></span>
                                              <span class="sidebar-normal">Настройки</span>', ['/settings']); ?>
                            </li>
                            <li>
                                <?= Html::a('<span class="sidebar-mini"><i class="material-icons">exit_to_app</i></span>
                                                  <span class="sidebar-normal">exit_to_app</span>', ['/logout'], [
                                    'data' => ['method' => 'post'],
                                ]); ?>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>
        <ul class="nav">
            <li>
                <a href="../dashboard.html">
                    <i class="material-icons">dashboard</i>
                    <p>Dashboard</p>
                </a>
            </li>

            <!-- закупки -->
            <li>
                <a data-toggle="collapse" href="#pagesOrders" aria-expanded="false" class="collapsed">
                    <i class="material-icons">store</i>
                    <p>Закупки
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse" id="pagesOrders">
                    <ul class="nav">
                        <?php if (Yii::$app->user->identity->current_organisation): ?>
                        <li>
                            <a href="#" data-action="pre-creation" data-action-url="/tender/create">
                                <i class="material-icons">add_shopping_cart</i>
                                <span class="sidebar-normal">Создать закупку</span>
                            </a>
                        </li>
                        <?php endif; ?>
                        <li>
                            <a href="../pages/timeline.html">
                                <i class="material-icons">shopping_cart</i>
                                <span class="sidebar-normal">Мои закупки</span>
                            </a>
                        </li>
                        <li>
                            <a href="../pages/login.html">
                                <i class="material-icons">search</i>
                                <span class="sidebar-normal">Поиск закупок</span>
                            </a>
                        </li>
                        <li>
                            <a href="../pages/register.html">
                                <i class="material-icons">hearing</i>
                                <span class="sidebar-normal">Отслеживание закупок</span>
                            </a>
                        </li>
                        <li>
                            <a href="../pages/register.html">
                                <i class="material-icons">reply</i>
                                <span class="sidebar-normal">Мои отклики</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <!-- о нас -->
            <li>
                <a data-toggle="collapse" href="#pagesAbout" aria-expanded="false" class="collapsed">
                    <i class="material-icons">library_books</i>
                    <p>О нас
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse" id="pagesAbout">
                    <ul class="nav">
                        <li>
                            <a href="../pages/pricing.html">
                                <i class="material-icons">info</i>
                                <span class="sidebar-normal">О нас</span>
                            </a>
                        </li>
                        <li>
                            <a href="../pages/timeline.html">
                                <i class="material-icons">contacts</i>
                                <span class="sidebar-normal">Контакты</span>
                            </a>
                        </li>
                        <li>
                            <a href="../pages/login.html">
                                <i class="material-icons">important_devices</i>
                                <span class="sidebar-normal">Технологии</span>
                            </a>
                        </li>
                        <li>
                            <a href="../pages/register.html">
                                <i class="material-icons">verified_user</i>
                                <span class="sidebar-normal">Правила использования</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>




            <!--<li>
                <a data-toggle="collapse" href="#componentsExamples">
                    <i class="material-icons">apps</i>
                    <p>Components
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse" id="componentsExamples">
                    <ul class="nav">
                        <li>
                            <a href="../components/buttons.html">
                                <span class="sidebar-mini">B</span>
                                <span class="sidebar-normal">Buttons</span>
                            </a>
                        </li>
                        <li>
                            <a href="../components/grid.html">
                                <span class="sidebar-mini">GS</span>
                                <span class="sidebar-normal">Grid System</span>
                            </a>
                        </li>
                        <li>
                            <a href="../components/panels.html">
                                <span class="sidebar-mini">P</span>
                                <span class="sidebar-normal">Panels</span>
                            </a>
                        </li>
                        <li>
                            <a href="../components/sweet-alert.html">
                                <span class="sidebar-mini">SA</span>
                                <span class="sidebar-normal">Sweet Alert</span>
                            </a>
                        </li>
                        <li>
                            <a href="../components/notifications.html">
                                <span class="sidebar-mini">N</span>
                                <span class="sidebar-normal">Notifications</span>
                            </a>
                        </li>
                        <li>
                            <a href="../components/icons.html">
                                <span class="sidebar-mini">I</span>
                                <span class="sidebar-normal">Icons</span>
                            </a>
                        </li>
                        <li>
                            <a href="../components/typography.html">
                                <span class="sidebar-mini">T</span>
                                <span class="sidebar-normal">Typography</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li>
                <a data-toggle="collapse" href="#formsExamples">
                    <i class="material-icons">content_paste</i>
                    <p>Forms
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse" id="formsExamples">
                    <ul class="nav">
                        <li>
                            <a href="../forms/regular.html">
                                <span class="sidebar-mini">RF</span>
                                <span class="sidebar-normal">Regular Forms</span>
                            </a>
                        </li>
                        <li>
                            <a href="../forms/extended.html">
                                <span class="sidebar-mini">EF</span>
                                <span class="sidebar-normal">Extended Forms</span>
                            </a>
                        </li>
                        <li>
                            <a href="../forms/validation.html">
                                <span class="sidebar-mini">VF</span>
                                <span class="sidebar-normal">Validation Forms</span>
                            </a>
                        </li>
                        <li>
                            <a href="../forms/wizard.html">
                                <span class="sidebar-mini">W</span>
                                <span class="sidebar-normal">Wizard</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li>
                <a data-toggle="collapse" href="#tablesExamples">
                    <i class="material-icons">grid_on</i>
                    <p>Tables
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse" id="tablesExamples">
                    <ul class="nav">
                        <li>
                            <a href="../tables/regular.html">
                                <span class="sidebar-mini">RT</span>
                                <span class="sidebar-normal">Regular Tables</span>
                            </a>
                        </li>
                        <li>
                            <a href="../tables/extended.html">
                                <span class="sidebar-mini">ET</span>
                                <span class="sidebar-normal">Extended Tables</span>
                            </a>
                        </li>
                        <li>
                            <a href="../tables/datatables.net.html">
                                <span class="sidebar-mini">DT</span>
                                <span class="sidebar-normal">DataTables.net</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li>
                <a data-toggle="collapse" href="#mapsExamples">
                    <i class="material-icons">place</i>
                    <p>Maps
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse" id="mapsExamples">
                    <ul class="nav">
                        <li>
                            <a href="../maps/google.html">
                                <span class="sidebar-mini">GM</span>
                                <span class="sidebar-normal">Google Maps</span>
                            </a>
                        </li>
                        <li>
                            <a href="../maps/fullscreen.html">
                                <span class="sidebar-mini">FSM</span>
                                <span class="sidebar-normal">Full Screen Map</span>
                            </a>
                        </li>
                        <li>
                            <a href="../maps/vector.html">
                                <span class="sidebar-mini">VM</span>
                                <span class="sidebar-normal">Vector Map</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li>
                <a href="../widgets.html">
                    <i class="material-icons">widgets</i>
                    <p>Widgets</p>
                </a>
            </li>
            <li>
                <a href="../charts.html">
                    <i class="material-icons">timeline</i>
                    <p>Charts</p>
                </a>
            </li>
            <li>
                <a href="../calendar.html">
                    <i class="material-icons">date_range</i>
                    <p>Calendar</p>
                </a>
            </li>-->
        </ul>
    </div>
</div>

<form action="/logout" method="post" id="logout" >
    <?= Html::csrfMetaTags() ?>
    <?= Html::hiddenInput('logout', '1'); ?>
</form>
