<?php
/**
 * Вьюха верхней панели меню для морды сайта
 * Подключается к main.php
 */

?>

<nav class="navbar navbar-default navbar-expand-lg pt-0 mb-0" color-on-scroll="100" id="sectionsNav">
    <div class="container">
        <div class="navbar-translate">
            <a class="pt-5" href="/">
                <img  height="90" src="/img/header-icon.png" alt="Главная страница закупатор" title="на главную">
            </a>

            <?php if (Yii::$app->params['show_site_description']): ?>
            <span class="navbar-brand text-12" style="line-height: 1; text-shadow: 1px 1px 1px black, 1px 1px -1px black;">b2b площадка закупок.<br>Биржа заказов и подрядчиков</span>
            <?php endif; ?>

            <?php if (Yii::$app->params['show_top_menu']): ?>
            <button class="navbar-toggler" type="button" data-toggle="collapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                <span class="navbar-toggler-icon"></span>
                <span class="navbar-toggler-icon"></span>
            </button>
            <?php endif; ?>
        </div>

        <?php if (Yii::$app->params['show_top_menu']): ?>

        <div class="collapse navbar-collapse flex-column">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item pr-20">
                    <i class="fas fa-phone mr-10"></i> 8 910 305-45-12
                </li>
                <li class="nav-item">
                    |
                </li>
                <li class="nav-item pl-20 pr-30">
                    8 953 475-69-50
                </li>
                <li class="nav-item pl-40">
                    <a class="nav-link" href="#"><i class="fas fa-envelope mr-5"></i> Напишите нам</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"><i class="fas fa-phone-square mr-5"></i> Консультация</a>
                </li>
            </ul>
            <ul class="navbar-nav flex-row ml-auto">

                <li class="dropdown nav-item">
                    <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                        <i class="fas fa-info-circle button-icon mr-1"></i> о площадке
                    </a>
                    <div class="dropdown-menu dropdown-with-icons">
                        <a href="/opportunities" class="dropdown-item">
                            <i class="fas fa-rocket submenu-icon"></i> Возможности
                        </a>
                        <a href="/restrictions" class="dropdown-item">
                            <i class="fas fa-ban submenu-icon"></i> Ограничения
                        </a>
                        <a href="/roadmap" class="dropdown-item">
                            <i class="fas fa-road submenu-icon"></i> Планы по развитию
                        </a>
                        <a href="/about" class="dropdown-item">
                            <i class="fas fa-users submenu-icon"></i> О нас
                        </a>
                        <a href="/support-us" class="dropdown-item">
                            <i class="fas fa-hands-helping submenu-icon"></i> Поддержать проект
                        </a>
                    </div>
                </li>


                <?php if (Yii::$app->user->isGuest): ?>
                    <li class="nav-item">
                        <a href="/login"  class="btn nav-link btn-link btn-block">
                            <i class="fas fa-sign-in-alt button-icon mr-1"></i> войти
                            <div class="ripple-container"></div>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="/registration" class="btn btn-primary btn-round btn-block">
                            <i class="fas fa-flag-checkered button-icon mr-1"></i> начать
                            <div class="ripple-container"></div>
                        </a>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a href="/cabinet" class="btn btn-primary btn-round btn-block">
                            <i class="fas fa-tachometer-alt button-icon mr-10"></i> рабочий кабинет
                            <div class="ripple-container"></div>
                        </a>
                    </li>
                <?php endif; ?>


            </ul>
        </div>
        <?php endif; ?>
    </div>
</nav>
