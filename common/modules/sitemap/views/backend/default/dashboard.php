<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/**
 * @var $this yii\web\View
 * @var $general_settings_info array - \modules\main\models\backend\GeneralSettings::getModuleSettingsInfo()
 */

$this->title = 'Управление Sitemap';
$this->params['breadcrumbs'][] = $this->title;
$this->params['pageTitle']     = $this->title;

$this->params['content-fixed'] = true;
$this->params['pageIcon'] = 'list-ul';
$this->params['place']    = 'sitemap';
?>
<div class="card card-outline card-primary">
    <div class="card-header">
        Базовые страницы
    </div>

    <div class="card-body ">


        <div class="row">
            <div class="col-md-8 col-sm-7">
                <p class="mt-10">
                    Базовые страницы - это по сути модуль site. Морда сайта. Для нее прописывается sitemap в ручную.
                    Как автоматом его сделать пока не знаю.
                </p>
            </div>
            <div class="col-md-4 col-sm-5">
                <?= Html::a('<i class="fa fa-list-ul"></i> Базовые страницы', ['sitemap/index'], ['class' => 'btn btn-success']) ?>
            </div>
        </div>

    </div>

</div>


<div class="card card-outline card-primary">
    <div class="card-header">
        Генерация Sitemap файлов
    </div>

    <div class="card-body ">
        <div class="row">
            <div class="col-md-8 col-sm-7">
                <p class="mt-10">
                    Sitemap файлы для закупок генерируются на основе активных, опубликованных, не приватных закупок.
                    Разбиваются на несколько файлов исходя из настроки "sitemap-size".
                </p>
                <p class="mt-10">
                    При генерации все файлы удаляются, потом генерируется sitemap для морды сайта, потом sitemap файлы закупок.
                    После них генерируется индексный sitemap, который нахожится по адресу "/files/sitemaps/sitemap.xml"
                </p>
            </div>
            <div class="col-md-4 col-sm-5">
                <button id="sitemap-generate" class="btn btn-warning">
                    <i class="fa fa-cogs"></i> &nbsp;Обновить sitemap файлы
                </button>
            </div>
        </div>

    </div>

</div>


<?= $this->render('@modules/main/views/backend/settings/_embeded_view', [
        'general_settings_info' => $general_settings_info
]); ?>


<?php
$generateUrl = \yii\helpers\Url::to(['sitemap/generate']);
$js = <<<JS

function initGenerateButtonHandler() {
    $('#sitemap-generate').on('click', function(event) {
        event.preventDefault();
        swal({
            title: 'Перегенерировать sitemap морды сайта?',
            html: "<small>Будет обновлен только sitemap файл со страницами из морды сайта. Sitemap объявлений или индексный sitemap останутся без изменений</small>",
            type: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Да',
            cancelButtonText: 'Нет'
        }).then((result) => {
            if (result.value) {
                swal.close();
                setTimeout(function() { generateSitemap(); }, 300);
            }
        });
    });
}

function generateSitemap() {
    $.ajax({
        type: 'GET',
        url: '$generateUrl',
        success: function(data) {
            swal(
                'Готово!',
                data.result,
                data.status
            );
        },
        error: function (data, b) {
            console.log(data);
            swal(
                'Ошибка!',
                'Не удалось сгенерировать sitemap. Подробнее в консоли и network браузера',
                'error'
            );
        }
    });
}
JS;

$this->registerJs($js, \yii\web\View::POS_END);

$jsReady = <<<JS
    initGenerateButtonHandler();
JS;

$this->registerJs($jsReady);