<?php
use yii\helpers\Html;

/**
 * Вьюха специально для меню в empty лейауте... тут более лайтовое меню
 */


?>

<nav class="navbar navbar-primary navbar-transparent navbar-absolute">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand pt-5" href="/">
                <img height="40" src="/img/logo/zakupator-transparent-sign-mini.png" alt="на главную" title="на главную">
            </a>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a href="/">
                        <i class="material-icons">home</i> На главную
                    </a>
                </li>
                <?php if(Yii::$app->user->isGuest): ?>
                    <li id="place-registration">
                        <a href="/registration">
                            <i class="material-icons">person_add</i> Регистрация
                        </a>
                    </li>
                    <li id="place-login">
                        <a href="/login">
                            <i class="material-icons">fingerprint</i> Войти
                        </a>
                    </li>
                    <li id="place-password-recovery">
                        <a href="/password-recovery">
                            <i class="material-icons">lock_open</i> Восстановление
                        </a>
                    </li>
                <?php endif; ?>
                <?php if(!Yii::$app->user->isGuest): ?>
                    <li id="place-logout">
                        <?= Html::a('<i class="material-icons">dashboard</i> Кабинет', ['/cabinet']); ?>
                    </li>
                    <li id="place-logout">
                        <?= Html::a('<i class="material-icons">business</i> Мои фирмы', ['/my-organisations']); ?>
                    </li>
                    <li id="place-logout">
                        <?= Html::a('<i class="material-icons">exit_to_app</i> Выйти', ['/logout'], [
                            'data' => ['method' => 'post'],
                        ]); ?>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>