<?php
use yii\helpers\Html;
use yii\helpers\Url;

/**
 * Created by PhpStorm.
 * User: evetrov
 * Date: 23.05.20
 * Time: 13:02
 */

?>


<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>


    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item d-none d-sm-inline-block">
            <a href="/" class="nav-link">Перейти на сайт</a>
        </li>
        <!-- User -->
        <li class="nav-item dropdown">
            <a href="#" class="nav-link" data-toggle="dropdown">
                <i class="fa fa-user"></i> &nbsp;
                <span><?= Html::encode(Yii::$app->user->identity->first_name). ' ' . Html::encode(Yii::$app->user->identity->last_name) ?></span>
            </a>

            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <a href="<?= Url::to(['/users/default/index']) ?>" class="dropdown-item">
                    <i class="fas fa-gear mr-2"></i>
                    <?= Yii::t('app', 'LINK_SETTING') ?>
                </a>

                <div class="dropdown-divider"></div>

                <a href="<?= Url::to(['/users/default/logout']) ?>" class="dropdown-item"  data-method="post">
                    <i class="fa fa-power-off"></i>
                    <?= Yii::t('app', 'LINK_EXIT') ?>
                </a>
            </div>
        </li>
        <!-- End User -->
    </ul>
</nav>
<!-- /.navbar -->
