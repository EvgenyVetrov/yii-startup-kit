<?php

/* @var $this yii\web\View */
/* @var $model modules\site\models\backend\PagesBlocks */

$this->title = 'Create Pages Blocks';
$this->params['pageTitle']     = 'Добавить блок';
$this->params['breadcrumbs'][] = ['label' => 'Блоки страниц', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Добавить блок';

$this->params['content-fixed'] = true;
$this->params['pageIcon'] = 'fas fa-sitemap';
$this->params['place']    = 'site-pages-blocks';
?>
<div class="pages-blocks-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
