<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel modules\users\models\backend\SearchProfiles */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title                   = 'Профили';
$this->params['pageTitle']     = $this->title;
$this->params['breadcrumbs'][] = $this->title;

$this->params['pageIcon'] = 'user-o';
$this->params['place']    = 'profiles';
?>
<div class="profiles-index box">

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
            'user_id',
            'org_id',
            'json_contacts',
            'custom_contacts',
            // 'role',
            // 'position',
            // 'invite_status',
            // 'invite_date',
            // 'invite_user',
            // 'status',
            // 'own_description',
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
