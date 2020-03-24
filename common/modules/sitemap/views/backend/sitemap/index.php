<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel modules\sitemap\models\backend\SearchSitemap */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title                   = 'Базовые записи sitemap';
$this->params['pageTitle']     = $this->title;
$this->params['breadcrumbs'][] = $this->title;

$this->params['pageIcon'] = 'list-ul';
$this->params['place']    = 'sitemap';
?>
<div class="sitemap-index box">

    <div class="box-header">
        <?= Html::a('<i class="fa fa-plus"></i> &nbsp;Добавить', ['create'], ['class' => 'btn btn-primary']) ?>
    </div>

        <?php Pjax::begin(); ?>
                <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <div class="box-body no-padding">
            <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [

                    'id',
            'name',
            'loc',
            'lastmod',
            'changefreq',
            // 'priority',
            // 'own_description',
            // 'status',
            // 'created_at',
            // 'updated_at',

        [
            'class'          => 'common\widgets\ActionColumn',
            'firstButton'    => 'view',
            'hiddenButtons'  => ['update', 'hr', 'delete'],
            'buttonOptions'  => [
                'delete' => function ($model){
                    $title       = Yii::t('app', 'CONFIRM_TITLE');
                    $description = 'Вы уверены что хотите удалить данную запись?';

                    $options = [
                        'toggle'        => 'confirm',
                        'method'        => 'post',
                        'title'         => $title,
                        'description'   => $description,
                    ];

                    return ['data' => $options];
                }
            ]
        ]
        ],
        ]); ?>
        </div>
        <?php Pjax::end(); ?>
</div>