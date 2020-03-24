<?php
/**
 * первый вариант лендоса
 */

$assetPath = Yii::$app->assetManager->getPublishedUrl(Yii::$app->params['faceAssetPath']);



$this->title = 'Закупатор - удобные закупки';
Yii::$app->params['SEO']['description'] = 'Закупатор - b2b доска объявлений о закупках для частных организаций, мастеров, фрилансеров. ';
Yii::$app->params['SEO']['keywords'] = 'закупки, объявления, b2b, закупатор, СНГ, Россия, Украина, Белоруссия';
?>

<div class="presentation-page page-header header-filter clear-filter black-filter" data-parallax="true" style="background-image: url('<?= $assetPath ?>/img/workshop-v2.jpg');">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-lg-6 text-left">
                <h1 class="title">Сэкономь до 50% бюджета на покупках</h1>
                <h3>Заполняй формы закупок и получай конкретные предложения без лишних вопросов</h3>
                <br>
                <div class="buttons">
                    <?php if (Yii::$app->user->isGuest): ?>
                    <a href="/registration" class="btn btn-danger btn-lg">
                        <strong>Зарегистрироваться на площадке *</strong>
                    </a>
                    <br>
                    <span class="text-12">* регистрация и использование бесплатны </span>
                    <?php else: ?>
                    <a href="/cabinet" class="btn btn-danger btn-lg">
                        <strong>Зайти в личный кабинет</strong>
                    </a>
                    <?php endif; ?>
                </div>
            </div>

            <div class="col-md-12 col-lg-6 text-right">
                <br>
                <br>
                <h2 class="title">Не трать ресурсы <br>на B2B продажи.</h2>
                <h3>Отправляй конкретные предложения <br> на подробные заказы</h3>
            </div>
        </div>
    </div>
</div>
