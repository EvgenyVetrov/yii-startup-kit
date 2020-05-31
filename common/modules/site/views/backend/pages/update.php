<?php

/* @var $this yii\web\View */
/* @var $model modules\site\models\backend\Pages */

$this->title = 'Update Pages: ' . $model->name;

$this->params['pageTitle']     = 'Изменить страницу';
$this->params['breadcrumbs'][] = ['label' => 'Страницы сайта', 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->name;

$this->params['content-fixed'] = true;
$this->params['pageIcon'] = 'fas fa-sitemap';
$this->params['place']    = 'site-pages';
?>
<div class="pages-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>


<?php

$url = \yii\helpers\Url::to(['pages-blocks/page-blocks', 'page_id' => $model->id]);
$urlSave = \yii\helpers\Url::to(['pages/save-block', 'page_id' => $model->id]);

$jsFunc = <<<JS

    function getPageBlocks() {
        $.ajax({
            type: 'GET',
            url: '$url',
            success: function(data) {
                $("#page-blocks-container").html(data);
            },
            error: function (data, b) {
                if( data.status >= 400 && data.status < 600) {
                    ajaxError(data, 'getPageBlocks()');
                }
            }, 
            complete: function() {
                if (swal.isVisible() && Swal.isLoading()) { Swal.close(); } 
                
            }
        });
    }
    
    
    function addNewBlock() {
        var blockId = $(document).find('#add-block-selector').val();
        if (!blockId) { return false; } 
        submitWaiter();
        $.ajax({
            type: 'GET',
            url: '$urlSave',
            data: {
                page_id: $model->id,
                block_id: blockId
            },
            success: function(data) {
                if (data.status == 'success') {
                    getPageBlocks();
                } 
                if (data.status == 'warning') {
                    Swal.close();
                    swal.fire('Внимание!', data.message, 'warning');
                } 
                if (data.status == 'error') {
                    Swal.close();
                    swal.fire('Ошибка!', data.message, 'error');
                }
            },
            error: function (data, b) {
                Swal.close();
                if( data.status >= 400 && data.status < 600) {
                    ajaxError(data, 'getPageBlocks()');
                }
            },
        });
        
    }
JS;

$this->registerJs($jsFunc, \yii\web\View::POS_END);

$urlDelete = \yii\helpers\Url::to(['pages/delete-block']);
$js = <<<JS
    getPageBlocks();

    $('body').on('click', '#add-block-btn', function(event) {
        event.preventDefault();
        addNewBlock();
    });
    
    $('body').on('click', '[data-action=delete-page-block]', function (event) {
        event.preventDefault();
        
        var blockId = $(event.target).closest('[data-action=delete-page-block]').data('block-id');
        
        submitWaiter();
        $.ajax({
            type: 'GET',
            url: '$urlDelete',
            data: {
                page_id: $model->id,
                block_id: blockId
            },
            success: function(data) {
                if (data.status == 'success') {
                    getPageBlocks();
                } 
                if (data.status == 'warning') {
                    Swal.close();
                    swal.fire('Внимание!', data.message, 'warning');
                } 
                if (data.status == 'error') {
                    Swal.close();
                    swal.fire('Ошибка!', data.message, 'error');
                }
            },
            error: function (data, b) {
                Swal.close();
                if( data.status >= 400 && data.status < 600) {
                    ajaxError(data, 'delete-page-block');
                }
            },
        });
        
    });
JS;

$this->registerJs($js, \yii\web\View::POS_READY);