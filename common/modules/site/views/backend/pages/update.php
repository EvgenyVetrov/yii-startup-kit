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

$js = <<<JS
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
            }
        });
    }
    
    
    function addNewBlock() {
        $('')
    }
JS;

$this->registerJs($js, \yii\web\View::POS_END);