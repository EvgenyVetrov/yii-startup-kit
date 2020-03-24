<?php
/**
 * @var $model \modules\blog\models\frontend\BlogPosts
 */


?>

<div class="card card-plain card-blog">
    <div class="row">
        <div class="col-md-5 pb-sm-10 pb-md-30 pb-lg-30 pb-xl-40">
            <div class="card-header card-header-image">
                <a href="#pablito">
                    <img class="img" src="<?= $model->generalImageUrl ?>">
                </a>
                <div class="colored-shadow" style="background-image: url(&quot;<?= $model->generalImageUrl ?>&quot;); opacity: 1;"></div></div>
        </div>
        <div class="col-md-7">
            <h6 class="card-category text-info"><?= $model->category->name ?></h6>
            <h3 class="card-title">
                <a href="#pablo"><?= $model->title ?></a>
            </h3>
            <p class="card-description">
                <?= $model->announce ?>
                <br>
            </p>
            <p class="pull-right text-right" >
                <a href="/p/<?= $model->id ?>" target="_blank"> Подробнее... </a>
            </p>
        </div>
    </div>
</div>
