<?php
/**
 * Главная страница сайта
 *
 * @var $this \yii\web\View
 */

$this->title = 'B2B биржа заказов и подрядчиков - Закупатор';
Yii::$app->params['SEO']['description'] = 'Закупатор - B2B биржа заказчиков и подрядчиков для частных организаций, мастеров, фрилансеров. Составьте объявление о закупке и получайте предложения без постоянных объяснений.';
Yii::$app->params['SEO']['keywords'] = 'закупки, объявления, заказ, b2b, закупатор, СНГ, Россия, Украина, Белоруссия, zakupator';

?>

<?= $this->render('index/_index_header'); ?>

<div class="main main-raised">
    <div class="section section-basic pt-30">
        <div class="container">
            <?= $this->render('index/_index_capabilities'); ?>
        </div>
    </div>


    <div class="section section-tabs">
        <div class="container">
            <?= $this->render('index/_index_principles'); ?>
        </div>
    </div>

    <?= $this->render('index/_pricing'); ?>
    <?= $this->render('index/_call_to_action'); ?>
    <?= $this->render('index/_about_us'); ?>

</div>

<script>
function registerServiceWorker() {
    // регистрирует скрипт sw в поддерживаемых браузерах
    if ('serviceWorker' in navigator) {
        navigator.serviceWorker.register('sw.js', { scope: '/' }).then(() => {
            console.log('Service Worker registered successfully.');
        }).catch(error => {
                console.log('Service Worker registration failed:', error);
        });
    }
}

window.onload = function() {
    //registerServiceWorker();
};
</script>