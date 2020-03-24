<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\Modal;
use yii\widgets\Breadcrumbs;
use themes\kit\assets\MainAsset;

/* @var $this yii\web\View */
/* @var $content string */
// Yii::$app->view->render('_left_menu');

MainAsset::register($this);

$assetPath = Yii::$app->assetManager->getPublishedUrl(Yii::$app->params['assetPath']);

if (Yii::$app->session->hasFlash('error')){
    $this->registerJs("
        swal({
          type: 'error',
          timer: 5000,
          html: '" . Yii::$app->session->getFlash('error') . "'
        });
    ");
}elseif (Yii::$app->session->hasFlash('warning')){
    $this->registerJs("
        swal({
          type: 'warning',
          html: '" . Yii::$app->session->getFlash('warning') . "'
        });
    ");
}elseif (Yii::$app->session->hasFlash('success')){
    $this->registerJs("
        swal({
          type: 'success',
          timer: 5000,
          html: '" . Yii::$app->session->getFlash('success') . "'
        });
    ");
}

$this->beginPage(); ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <meta name="robots" content="<?= YII_ENV_PROD ? Yii::$app->params['robots'] : 'none' ?>" />
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <meta name="description" content="<?= Yii::$app->params['SEO']['description'] ?>">
    <meta name="keywords" content="<?= Yii::$app->params['SEO']['keywords'] ?>">
    <link rel="shortcut icon" href="/img/favicon-16.png" type="image/png">
    <?php $this->head() ?>


</head>
<body class="sidebar-collapse">
<?php $this->beginBody(); ?>
<?= Yii::$app->view->render('_top_menu'); ?>

<?= $content ?>

<?= Yii::$app->view->render('_footer'); ?>

<?php if (Yii::$app->user->can('admin') === false AND YII_ENV == 'prod'): ?>
    <?= $this->renderFile('@common/views/analytics_counters.php') ?>
<?php endif; ?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>