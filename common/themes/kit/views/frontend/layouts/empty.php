<?php

use yii\helpers\Html;
use themes\kit\assets\MainAsset;
/**
 * Пустой лейаут - без верхнего и бокового меню. Сверху картинка на всю ширину, которую можно и нужно конфигурировать
 * под конкретную страницу. Этакая атмосферная картинка.
*/
/* @var $this yii\web\View */
/* @var $content string */

$this->params['atmospheric_bg'] = isset($this->params['atmospheric_bg']) ? $this->params['atmospheric_bg'] : 'img16.jpg';

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

$assetPath = Yii::$app->assetManager->getPublishedUrl(Yii::$app->params['assetPath']); // путь для подгрузки ассетов (хеш + путь к ассетам)
$this->beginPage(); ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="robots" content="<?= YII_ENV_PROD ? Yii::$app->params['robots'] : 'none' ?>" />
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <link rel="shortcut icon" href="/img/favicon-16.png" type="image/png">
    <?php $this->head() ?>

</head>
<body class="off-canvas-sidebar">
<?php $this->beginBody() ?>
<?= Yii::$app->view->render('_menu_empty'); ?>
<div class="wrapper wrapper-full-page">
    <div class="full-page register-page" filter-color="black" data-image="<?= $assetPath ?>/img/register.jpeg">
        <div class="container">
            <?= $content ?>
        </div>
        <?= Yii::$app->view->render('_footer_empty'); ?>

        <div class="full-page-background" style="background-image: url(<?= $assetPath ?>/img/register.jpeg) "></div>
    </div>
</div>


<?php if (Yii::$app->user->can('admin') === false): ?>
    <?= $this->renderFile('@common/views/analytics_counters.php') ?>
<?php endif; ?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>