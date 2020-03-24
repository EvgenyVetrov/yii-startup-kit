<?php
/**
 * Страница с планами развития
 *
 * @var $model \modules\feedback\models\frontend\Feedback
 */


$this->title = 'О нас';
Yii::$app->params['SEO']['description'] = 'Информация о закупаторе. Контакты и обратная связь.';
Yii::$app->params['SEO']['keywords'] = 'о нас, закупатор, контакты, социальные сети, обратная связь';

?>


<?= $this->render('_header'); ?>

<div class="main main-raised">

    <div class="section pb-30">
        <div class="container">
            <div class="col-md-8 ml-auto mr-auto">
                <div class="section-description">
                    <h5 class="description">
                        Zakupator.org -
                        площадка для организации закупок частных организаций с системой составления
                        грамотных требований и поиском. Площадка рассчитана на использование субъектами предпринимательства с разным масштабом деятельности
                        - от мастеров и фрилансеров, до корпораций и объединений на территории разных стран и регионов (пока преимущественно СНГ).
                    </h5>

                    <h5 class="description">
                        Площадка и основные ее функции бесплатны и внедрения платных условий использования основного функционала
                        не планируется. Оплата сервиса добровольная. Возможно в будущем будут специальные функции для
                        пользователей с масштабной деятельностью за незначительную плату.
                    </h5>
                </div>
            </div>
        </div>
    </div>

    <?php $this->render('_list'); ?>
    <?= $this->render('_contact', ['model' => $model]); ?>

</div>
