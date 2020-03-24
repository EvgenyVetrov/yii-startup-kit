<?php

use yii\helpers\Html;
use yii\grid\GridView;
use modules\main\models\backend\Cities;

/* @var $this yii\web\View */
/* @var $searchModel modules\main\models\backend\SearchCities */
/**
 * @var $countActiveCities integer - количество активных городов
 * @var $dataProvider yii\data\ActiveDataProvider
 */

$this->title                   = 'Населенные пункты';
$this->params['pageTitle']     = $this->title;
$this->params['breadcrumbs'][] = $this->title;

$this->params['place'] = 'cities';
?>
<div class="cities-index box">

                    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    
    <div class="box-header">
        <?= Html::a('<i class="fa fa-plus"></i> Добавить', ['create'], ['class' => 'btn btn-primary']) ?>
        <span class="pull-right text-14">активных городов: <?= $countActiveCities ?></span>
    </div>
    <div class="box-body no-padding">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'rowOptions'=>function ($model, $key, $index, $grid){
                if ($model->status == 1) {
                    return ['class' => 'success'];
                }
            },
            'columns' => [

                'id',
                'name',
                'district_id',
                'population',
                'sort',
                [
                    'attribute' => 'status',
                    'content' => function($data){
                        return Cities::STATUS_LABELS[(int)$data->status];
                    },
                    'filter' => Cities::STATUS_LABELS
                ],
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
    </div>
