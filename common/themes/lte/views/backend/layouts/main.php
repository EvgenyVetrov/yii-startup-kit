<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\Modal;
use yii\widgets\Breadcrumbs;
use themes\lte\assets\MainAsset;

/* @var $this yii\web\View */
/* @var $content string */

MainAsset::register($this);

if (isset($this->params['place'])){
    $this->registerJs('
        var place = $("#place-' . $this->params['place'] . '");
        if (place.parent().parent().prop("tagName") == "LI"){
            place.parent().parent().addClass("open");
            place.parent().show();
        }
        place.addClass("active");
    ');
}

$contentFixed = false; /* определяем будет ли во вьюхе ширина контента статична (в рамках бустрап границ) или будет на всю ширину */
if(isset($this->params['content-fixed']) AND $this->params['content-fixed'] == true) { $contentFixed = true; }

$assetPath = Yii::$app->assetManager->getPublishedUrl(Yii::$app->params['assetPath']);
$push_menu = isset($_COOKIE['push_menu']) && $_COOKIE['push_menu'] == 'close' ? 'sidebar-collapse' : '';
?><?php $this->beginPage(); ?>
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="<?= Yii::$app->charset ?>"/>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <meta name="robots" content="noindex, nofollow" />
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>

        <link rel="shortcut icon" href="<?= $assetPath ?>/dist/img/favicon/icon_16.png" type="image/png">
        <link rel="apple-touch-icon" href="<?= $assetPath ?>/dist/img/favicon/icon_60.png">
        <link rel="apple-touch-icon" sizes="76x76" href="<?= $assetPath ?>/dist/img/favicon/icon_76.png">
        <link rel="apple-touch-icon" sizes="120x120" href="<?= $assetPath ?>/dist/img/favicon/icon_120.png">
        <link rel="apple-touch-icon" sizes="152x152" href="<?= $assetPath ?>/dist/img/favicon/icon_152.png">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="hold-transition skin-blue sidebar-mini <?= $push_menu ?>">
    <?php $this->beginBody() ?>
    <!-- Site wrapper -->
    <div class="wrapper">

        <header class="main-header">
            <!-- Logo -->
            <a href="<?= Url::to(['/']) ?>" class="logo hidden-xs">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini">
                    <?= mb_substr(Yii::$app->name, 0, 1) ?>
                </span>
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg">
                    <?= Yii::$app->name ?>
                </span>
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <li>
                            <a href="/" target="_blank">
                                <i class="fa fa-external-link"></i> &nbsp;
                                <span>Перейти на сайт</span>
                            </a>
                        </li>

                        <!-- User -->
                        <li>
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-user"></i> &nbsp;
                                <span><?= Html::encode(Yii::$app->user->identity->first_name). ' ' . Html::encode(Yii::$app->user->identity->last_name) ?></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="<?= Url::to(['/users/default/index']) ?>">
                                        <i class="fa fa-gear"></i>
                                        <?= Yii::t('app', 'LINK_SETTING') ?>
                                    </a>
                                </li>
                                <li class="divider"></li>
                                <li>
                                    <a href="<?= Url::to(['/users/default/logout']) ?>" data-method="post">
                                        <i class="fa fa-power-off"></i>
                                        <?= Yii::t('app', 'LINK_EXIT') ?>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <!-- End User -->
                    </ul>
                </div>
            </nav>
        </header>

        <!-- Left side column. contains the logo and sidebar -->
        <?= Yii::$app->view->render('_main_left_menu'); ?>



        <!-- =============================================== -->

        <!-- =============================================== -->

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <?php if (isset($this->params['pageTitle'])): ?>
                    <h1>
                        <?php if (isset($this->params['pageIcon'])): ?>
                            <i class="fa fa-<?= $this->params['pageIcon'] ?>"></i> &nbsp;
                        <?php endif; ?>
                        <?= Html::encode($this->params['pageTitle']); ?>
                    </h1>
                <?php endif; ?>
                <?= Breadcrumbs::widget([
                    'homeLink' => [
                        'label' => Yii::t('app', 'LINK_HOME'),
                        'url' => ['/']
                    ],
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : []
                ]) ?>
            </section>

            <!-- Main content -->
            <section class="content <?= $contentFixed ? 'content-fixed' : '' ?>">
                <?= $content ?>
            </section><!-- /.content -->
        </div><!-- /.content-wrapper -->

        <footer class="main-footer">
            <strong>
                &copy; <a href="<?= Url::to(['/']) ?>"><?= Yii::$app->name ?></a> <span class="pull-right">v.<?= Yii::$app->params['backend-version'] ?></span>
            </strong>
        </footer>

        <div class="control-sidebar-bg"></div>
    </div><!-- ./wrapper -->

    <?php
    if (Yii::$app->session->hasFlash('success')){
        Modal::begin([
            'id'            => 'message-success',
            'clientOptions' => ['show' => true],
            'header'        => '<h4 class="modal-title">' . Yii::t('app', 'TITLE_MODAL_SUCCESS') . '</h4>',
        ]);
        echo '<p>' . Yii::$app->session->getFlash('success') . '</p>';
        Modal::end();
    }elseif (Yii::$app->session->hasFlash('error')){
        Modal::begin([
            'id'            => 'message-error',
            'clientOptions' => ['show' => true],
            'headerOptions' => ['class' => 'bg-red'],
            'header'        => '<h4 class="modal-title">' . Yii::t('app', 'TITLE_MODAL_ERROR') . '</h4>',
        ]);
        echo '<p>' . Yii::$app->session->getFlash('error') . '</p>';
        Modal::end();
    }elseif (Yii::$app->session->hasFlash('warning')){
        Modal::begin([
            'id'            => 'message-warning',
            'clientOptions' => ['show' => true],
            'headerOptions' => ['class' => 'bg-yellow'],
            'header'        => '<h4 class="modal-title">' . Yii::t('app', 'TITLE_MODAL_WARNING') . '</h4>',
        ]);
        echo '<p>' . Yii::$app->session->getFlash('warning') . '</p>';
        Modal::end();
    }
    ?>

    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>