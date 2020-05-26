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
$this->params['pageTitle'] = '';
?>
<h2>Добро пожаловать!</h2>
<p>Это главная страница админки сайта. Тут можно
вывести базовую информацию, быстрые ссылки для удобства, показатели работы сайта.</p>

<div class="row">
    <div class="col-lg-3 col-xs-6">

        <div class="small-box bg-info">
            <div class="inner">
                <h3><?= $active_emails ?></h3>

                <p>Подтвержденных email</p>
            </div>
            <div class="icon">
                <i class="fas fa-users"></i>
            </div>
            <a href="#" class="small-box-footer">
                More info <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>

    </div>

    <div class="col-lg-3 col-xs-6">

        <div class="small-box bg-info">
            <div class="inner">
                <h3><?= $new_feedbacks ?></h3>

                <p>Новых обращений</p>
            </div>
            <div class="icon">
                <i class="fas fa-envelope"></i>
            </div>
            <a href="#" class="small-box-footer">
                More info <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

</div>
