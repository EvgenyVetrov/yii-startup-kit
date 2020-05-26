<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel modules\main\models\backend\SearchCountries */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title                   = 'Библиотека стран';
$this->params['pageTitle']     = $this->title;
$this->params['breadcrumbs'][] = $this->title;

$this->params['place'] = 'countries';
?>
<div class="countries-index card card-primary card-outline">

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
            'code',
            'name',
            'alpha2',
            'sort',
            // 'status',
            // 'created_at',
            // 'updated_at',
            [
                'class' => \yii\grid\ActionColumn::class,
                'template' => '{view} {update} {delete}',
            ],
        ],
        ]); ?>
        </div>
    </div>
