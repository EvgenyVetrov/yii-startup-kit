<?php

/**
 * Главная страница админки
 *
 * @var $this \yii\web\View
 * @var $active_emails int     - количество активированных емайлов
 * @var $new_feedbacks int     - количество непрочитанных фидбэков
 * @var $avtive_tenders int    - количество активных опубликованных закупок
 * @var $public_tenders int    - количество активных опубликованных публичных закупок
 * @var $promo_tenders int     - количество активных опубликованных промо закупок
 * @var $tenders_notifications - массив инфы о запуске скрипта обхода поиска новых закупок и рассылки нотификаций
 */

$this->title = 'Админка | ' . Yii::$app->name;
?>
<div class="row">
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-aqua height-105">
            <div class="inner">
                <h3><?= $active_emails ?></h3>

                <p>Подтвержденных email</p>
            </div>
            <div class="icon">
                <i class="fa fa-user"></i>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-lime-active height-105">
            <div class="inner">
                <h3><?= $new_feedbacks ?></h3>

                <p>Новых обращений</p>
            </div>
            <div class="icon">
                <i class="fa fa-envelope"></i>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-orange-active height-105">
            <div class="inner">
                <h3><?= $avtive_tenders ?></h3>

                <p class="mb-0" style="line-height: 1.1">
                    Активных закупок<span class="text-12">, включая:</span><br>
                    <span class="text-12"><?= $promo_tenders ?> - промо, <?= $public_tenders ?> - публичных</span>
                </p>

            </div>
            <div class="icon">
                <i class="fa fa-shopping-cart"></i>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box <?= $tenders_notifications['is_ok'] ? 'bg-green' : 'bg-red'  ?> height-105">
            <div class="inner">
                <h3><?= $tenders_notifications['minutes_ago_launch'] ?> <span class="text-14">мин. назад</span></h3>

                <p class="mb-0" style="line-height: 1.1">
                    был поиск новых закупок<br>
                    <span class="text-12"><?= $tenders_notifications['found_tenders_counter'] ?> - найдено</span>
                </p>

            </div>
            <div class="icon">
                <i class="fa fa-shopping-cart"></i>
            </div>
        </div>
    </div>

</div>
<br><br>
Что осталось сделать: <br>

- доделать подписки и уведомления <br>
- сделать автовыбор текущей организации <br>
- сделать кликабельным переход внутрь организации (для тачей чтоб норм было) <br> <br>
- на сервере заблокировать root юзера <br>
- привлечь реальных пользователей побольше и добиться составления реальной закупки. Потом правдами и неправдами лично
найти исполнителей этой закупки даже вне сервиса, звонить искать. В общем как угодно, лиж бы удовлетворить запрос <br>
- найти пользователей с которыми лично/онлайн пройти всю регистрацию и составление закупки и спросить их мнения <br>
- визитки сделать <br>
- разослать письма бумажные зарегистрировавшимся и кого удасться найти адрес, даже рабочий. С вложенными парой визиток. <br>
<br>
<br>
- сделать прямые ссылки на закупки через дерево категорий<br>
- сделать карусель из нескольких закупок на главной<br>
- <span class="text-muted">ввести сосртировку категорий</span> <br>
- <span class="text-muted">когда будет много закупок рассмотреть возможность сделать поиск на морде сайта</span> <br>




