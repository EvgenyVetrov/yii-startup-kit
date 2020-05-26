<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel modules\feedback\models\backend\FeedbackSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title                   = 'Список обращений';
$this->params['pageTitle']     = $this->title;
$this->params['breadcrumbs'][] = $this->title;

$this->params['place']     = 'feedback';
$this->params['content-fixed'] = false; /* фиксируем ширину */
?>
<div class="feedback-index card card-primary card-outline">

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
            'user_id',
            'email:email',
            'org_id',
            'type',
            // 'object',
            // 'object_id',
            // 'text',
            // 'ip',
            // 'user_agent',
            // 'device_info:ntext',
            // 'own_description',
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
