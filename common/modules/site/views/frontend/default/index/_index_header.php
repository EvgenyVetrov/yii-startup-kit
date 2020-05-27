<?php
/**
 * Заголовок страницы (атмосферная картинка) морды сайта.
 * По сути первое что аидит юзер на сайте
 */

$assetPath = Yii::$app->assetManager->getPublishedUrl(Yii::$app->params['faceAssetPath']);
?>

<div class="presentation-page page-header header-filter clear-filter dark-filter"
     data-parallax="true"
     style="background-image: url('/img/bg/white-pattern-medium.png'); background-repeat: repeat; background-position: center; background-size: auto;">
    <div class="container">
        <div class="row">
            <div class="col-md-8 ml-auto mr-auto">
                <div class="brand">
                    <!--<h1 hidden>Zakupator&nbsp;<span class="pro-badge">.org</span></h1>-->
                    <h1 hidden>Закупатор</h1>
                    <div style="
                    height: 150px;
                    background-size: contain;
                    background-image: url('/img/logo/zakupator-dark-transparent-horizon-rus-medium.png');
                    background-repeat: no-repeat;
                    background-position: center;">

                    </div>
                    
                    <h3>B2B площадка закупок. Биржа <br> поставщиков и заказчиков.</h3>
                </div>
            </div>
        </div>
    </div>
</div>



