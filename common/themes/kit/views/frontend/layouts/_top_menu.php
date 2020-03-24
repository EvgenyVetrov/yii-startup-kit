<?php
/**
 * Вьюха верхней панели меню для морды сайта
 * Подключается к main.php
 */

?>

<nav class="navbar navbar-transparent navbar-color-on-scroll fixed-top navbar-expand-lg" color-on-scroll="100" id="sectionsNav">
    <div class="container">
        <div class="navbar-translate">
            <a class="navbar-brand pt-5" href="/">
                <img  height="40" src="/img/logo/zakupator-transparent-sign-mini.png" alt="Главная страница закупатор" title="на главную">
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
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ml-auto">



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
