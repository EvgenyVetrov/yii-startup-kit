<?php

use yii\helpers\Html;
use yii\grid\GridView;
use modules\main\models\backend\Districts;

/* @var $this yii\web\View */
/* @var $searchModel modules\main\models\backend\SearchDistricts */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title                   = 'Библиотека областей';
$this->params['pageTitle']     = $this->title;
$this->params['breadcrumbs'][] = $this->title;

$this->params['place'] = 'districts';
?>
<div class="districts-index card card-primary card-outline">

                    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    
    <div class="card-header">
        <?= Html::a('<i class="fa fa-plus"></i> Добавить', ['create'], ['class' => 'btn btn-primary']) ?>
    </div>
    <div class="card-body no-padding">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'rowOptions'=>function ($model, $key, $index, $grid){
                if ($model->status == 0) {
                    return ['class' => 'opacity-30'];
                }
            },
            'columns' => [

                'id',
                'country_id',
                'name',
                [
                    'attribute' => 'status',
                    'content' => function($data){
                        return Districts::STATUS_LABELS[(int)$data->status];
                    },
                    'filter' => Districts::STATUS_LABELS
                ],
                // 'created_at',
                // 'updated_at',
                // 'sort',

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
