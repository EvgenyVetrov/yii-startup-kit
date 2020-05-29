<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel modules\site\models\backend\SearchPagesBlocks */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title                   = 'Блоки страниц';
$this->params['pageTitle']     = $this->title;
$this->params['breadcrumbs'][] = $this->title;

$this->params['content-fixed'] = false;
$this->params['pageIcon'] = 'fas fa-sitemap';
$this->params['place']    = 'site-pages-blocks';
?>
<div class="pages-blocks-index card card-primary card-outline">

        <?php Pjax::begin(); ?>
                <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    
    <div class="card-header">
        <?= Html::a('<i class="fa fa-plus"></i> Добавить', ['create'], ['class' => 'btn btn-primary']) ?>
    </div>
    <div class="card-body no-padding">
            <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            'name',
            'alias',
            //'content:ntext',
            //'own_description',
            // 'status',
            // 'created_at:datetime',
            'updated_at:datetime',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {delete}',
            ],
    ],
]); ?>
        </div>
        <?php Pjax::end(); ?>
</div>
