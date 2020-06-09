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
        Страницы сайта
    </div>

    <div class="card-body ">


        <div class="row">
            <div class="col-md-12">
                <p class="mt-10">
                    Произвольные страницы сайта (виртуальные и захардкоженные) берутся из
                    <?= Html::a('списка страниц', ['pages/index']); ?>. Берутся только активные страницы.
                    Захардкоженные страницы нужно не забывать добавлять в этот <?= Html::a('список страниц', ['pages/index']); ?>.
                    Ответственно относитесь к заполнению SEO части страницы.
                </p>
                <p>
                    Страницы блога берутся из <?= Html::a('этого раздела', ['blog/posts/index']); ?>. Там так же нужно
                    подробно заполнять SEO поля, так как они в том числе используются для генерации sitemap файлов.
                </p>
                <p>При разработке нового функционала, который будет отображать новые типы страниц для пользователей и
                которые нужно индексировать (например: каталог товаров или объявлений, публичные профили),
                необходимо учесть SEO и доработать генератор sitemap файлов, чтобы он начал захватывать новые типы страниц.</p>
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
                    Sitemap файлы генерируются на основе активных захардкоженных и виртуальных страниц, опубликованных статей
                    и новостей. Разбиваются на несколько файлов исходя из настроки "sitemap-size".
                </p>
                <p class="mt-10">
                    При генерации все файлы удаляются, потом генерируется sitemap файлы произвольных страниц, sitemap
                    файлы блога. Можно было бы генерировать общий sitemap файл, но проще по отдельности.
                    После них генерируется индексный sitemap, объединяющий все остальные.

                </p>
                <p>
                    Сгенерированный индексный файл должен находится тут: <code>/files/sitemaps/sitemap.xml</code> &nbsp; Его и остальные
                    сгенерировнные файлы можно посмотреть в <?= Html::a('менеджере файлов', ['file-manager/index']); ?>.
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
        swal.fire({
            title: 'Перегенерировать sitemap морды сайта?',
            html: "<small>Будет обновлен только sitemap файл со страницами из морды сайта и индексный. Sitemap файлы блога и других модулей пока не генерируются</small>",
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
            swal.fire(
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