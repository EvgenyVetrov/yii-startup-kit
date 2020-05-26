<?php

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;

/**
 * Created by PhpStorm.
 * User: evetrov
 * Date: 23.05.20
 * Time: 13:41
 */


?>

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="text-secondary">
                    <?php if ($pageIcon): ?>
                        <i class="<?= $pageIcon ?>"></i> &nbsp;
                    <?php endif; ?>
                    <?= $pageTitle; ?>
                </h1>
            </div>
            <div class="col-sm-6">
                <?= Breadcrumbs::widget([
                    'tag'     => 'ol',
                    'encodeLabels' => false,
                    'options' => [
                        'class' => 'breadcrumb float-sm-right',//этот класс стоит по умолчанию
                    ],
                    'homeLink' => [
                        'label' => '<i class="fas fa-tachometer-alt"></i>',
                        'url'   => ['/'],
                    ],
                    'itemTemplate'       => '<li class="breadcrumb-item">{link}</li>',
                    'activeItemTemplate' => '<li class="breadcrumb-item active">{link}</li>',//"<li class=\"breadcrumb-item active\">{link}</li>",​
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ]) ?>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>






