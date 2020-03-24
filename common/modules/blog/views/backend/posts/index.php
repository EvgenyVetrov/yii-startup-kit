<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel modules\blog\models\backend\SearchBlogPosts */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title                   = 'Статьи для блога';
$this->params['pageTitle']     = $this->title;
$this->params['breadcrumbs'][] = $this->title;

$this->params['pageIcon'] = 'file-text-o';
$this->params['place']    = 'blog-posts';
?>
<div class="blog-posts-index box">

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
            'title',
            'bg_image',
            'general_image',
            'alt_image',
            // 'announce',
            // 'text:ntext',
            // 'creation_date',
            // 'publication_date',
            // 'category',
            // 'seo_keywords',
            // 'seo_description',
            // 'canonical_url:url',
            // 'author_id',
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
