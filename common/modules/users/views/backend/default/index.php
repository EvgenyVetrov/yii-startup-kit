<?php

use yii\helpers\Html;
use yii\grid\GridView;
use modules\users\Module;
use modules\users\models\backend\Users;

/* @var $this yii\web\View */
/* @var $searchModel modules\users\models\backend\search\Users */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title                     = 'Пользователи';
$this->params['pageTitle']       = $this->title;

$this->params['place']           = 'users';
$this->params['pageIcon']        = 'fas fa-users';
$this->params['breadcrumbs'][]   = $this->title;
?>

<div class="card card-primary card-outline">
    <?php if (Yii::$app->user->can('users-crud')): ?>
        <div class="card-header">
            <?= Html::a('<i class="fa fa-plus"></i> Добавить пользователя', ['create'], [
                'class' => 'btn btn-primary'
            ]) ?>
        </div>
    <?php endif ?>

    <div class="card-body no-padding">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                'id',
                [
                    'attribute'      => 'first_name',
                    'headerOptions'  => ['data-hide'  => 'xs'],
                ],
                'email',
                [
                    'attribute'      => 'time_registration',
                    'label' => 'Зарегистрирован',
                    'format'=> ['date', 'HH:mm &#160; dd.MM.Y'],
                ],
                [
                    'class' => \yii\grid\ActionColumn::class,

                    /**
                     * Определяем набор кнопок. По умолчанию {view} {update} {delete}
                     */
                    'template' => '{view} {update} {delete}',
                ],
                //[
                    //'class'          => 'yii\grid\ActionColumn',
                    //'firstButton'    => 'view',
                    /*'hiddenButtons'  => ['update', 'auth', ], ///'hr', 'delete'
                    'headerOptions'  => [
                        'data-hide'  => 'xs,sm,md',
                        'data-name'  => Yii::t('app', 'LABEL_ACTIONS')
                    ],
                    'visibleButtons' => [
                        'view'   => true,
                        'auth'   => Yii::$app->user->can('users-auth'),
                        'update' => Yii::$app->user->can('users-crud'),
                        'delete' => Yii::$app->user->can('users-crud'),
                    ],
                    'buttons' => [
                        'auth' => function ($key, $model){
                            // @var $model Users
                            if ($model->id != Yii::$app->user->id){
                                return Html::a('<i class="fa fa-key"></i> Авторизация', ['auth', 'id' => $model->id], [
                                    'data' => [
                                        'method' => 'post'
                                    ]
                                ]);
                            }
                        }
                    ],
                    'buttonOptions'  => [
                        'delete' => function ($model){
                            // @var $model Users
                            $title       = Yii::t('app', 'CONFIRM_TITLE');
                            $description = Module::t('main', 'CONFIRM_DELETE_DESCRIPTION_{user}', [
                                'user' => $model->first_name
                            ]);

                            $options = [
                                'toggle'        => 'confirm',
                                'method'        => 'post',
                                'title'         => $title,
                                'description'   => $description,
                            ];

                            return ['data' => $options];
                        }
                    ]*/
                //],
                [
                    'headerOptions'  => ['data-class' => 'expand', 'data-hide' => 'lg, pc, other'],
                    'value' => function(){
                        return '';
                    },
                ],
            ],
        ]); ?>
    </div>
</div>