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
<div class="countries-index box">

                    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    
    <div class="box-header">
        <?= Html::a('<i class="fa fa-plus"></i> Добавить', ['create'], ['class' => 'btn btn-primary']) ?>
    </div>
    <div class="box-body no-padding">
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
