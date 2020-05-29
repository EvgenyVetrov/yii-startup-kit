<?php

/* @var $this yii\web\View */
/* @var $model modules\site\models\backend\PagesBlocks */

$this->title = 'Update Pages Blocks: ' . $model->name;

$this->params['pageTitle']     = 'Изменить блок';
$this->params['breadcrumbs'][] = ['label' => 'Блоки страниц', 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->name;

$this->params['content-fixed'] = true;
$this->params['pageIcon'] = 'fas fa-sitemap';
$this->params['place']    = 'site-pages-blocks';
$this->params['content-fixed'] = true;
?>
<div class="pages-blocks-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
