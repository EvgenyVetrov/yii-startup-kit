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

    <link rel="shortcut icon" href="/img/icon-16.png" type="image/png">
    <link rel="apple-touch-icon" href="<?= $assetPath ?>/dist/img/favicon/icon_60.png">
    <link rel="apple-touch-icon" sizes="76x76" href="<?= $assetPath ?>/dist/img/favicon/icon_76.png">
    <link rel="apple-touch-icon" sizes="120x120" href="<?= $assetPath ?>/dist/img/favicon/icon_120.png">
    <link rel="apple-touch-icon" sizes="152x152" href="<?= $assetPath ?>/dist/img/favicon/icon_152.png">

</head>
<body class="hold-transition skin-blue sidebar-mini <?= $push_menu ?>">
<?php $this->beginBody() ?>
<!-- Site wrapper -->
    <div class="wrapper">


        <?= Yii::$app->view->render('_main_navbar'); ?>
        <?= Yii::$app->view->render('_main_left_menu'); ?>


        <!-- =============================================== -->

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <?= Yii::$app->view->render('_content_header'); ?>

            <!-- Main content -->
            <section class="content ml-auto mr-auto <?= $contentFixed ? 'content-fixed' : '' ?>">
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


    <?= Yii::$app->view->render('_flashes'); ?>
    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage();

