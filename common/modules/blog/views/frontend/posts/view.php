<?php
/**
 * Страница просмотра конкретного поста
 *
 * @var $model \modules\blog\models\frontend\BlogPosts
 */

$this->params['pageTitle']     = $model->title;

Yii::$app->params['SEO']['description'] = $model->seo_description;
Yii::$app->params['SEO']['keywords']    = $model->seo_keywords;

?>


<div class="page-header header-filter header-small" data-parallax="true" style="background-image: url(<?= $model->getPostBgImageUrl() ?>); transform: translate3d(0px, 0px, 0px);">
    <div class="container">
        <div class="row">
            <div class="col-md-8 ml-auto mr-auto text-center">
                <h1 class="title"><?= $model->title ?></h1>
            </div>
        </div>
    </div>
</div>



<div class="main main-raised">
    <div class="container">
        <div class="section section-text">
            <?= $model->text ?>
        </div>
        <div class="section section-blog-info">

            <div class="row">
                <div class="col-md-8 ml-auto mr-auto text-center">
                    <a href="/blog" class="btn btn-info">К списку всех записей</a>
                </div>
            </div>
        </div>
    </div>
</div>