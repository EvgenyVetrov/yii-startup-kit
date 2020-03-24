<?php
/**
 * Заголовок страницы для списков постов
 *
 * @var $header_image string - '/img/blog/list-headers/bg9.jpg'
 * @var $header_h1 string
 */

$header_image = $header_image ? $header_image : '/img/blog/list-headers/bg9.jpg';
$header_h1 = $header_h1 ? $header_h1 : 'Подборка полезных статей';
?>


<div class="page-header header-filter header-small"
     data-parallax="true"
     style="background-image: url('<?= $header_image ?>');">
    <div class="container">
        <div class="row">
            <div class="col-md-8 ml-auto mr-auto text-center">
                <h1 class="title"><?= $header_h1 ?></h1>
            </div>
        </div>
    </div>
</div>
