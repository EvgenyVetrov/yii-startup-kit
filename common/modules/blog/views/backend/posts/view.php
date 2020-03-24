<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model modules\blog\models\backend\BlogPosts */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Статьи для блога', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['pageTitle']     = $this->title;

$this->params['content-fixed'] = true;
$this->params['pageIcon'] = 'file-text-o';
$this->params['place']    = 'blog-posts';
?>
<div class="box">
    <div class="box-header">
        <?= Html::a('<i class="fa fa-edit"></i> Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
        <?= Html::a('<i class="fa fa-times"></i> Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
                'data' => [
                'toggle'        => 'confirm',
                'method'        => 'post',
                'title'         => Yii::t('app', 'CONFIRM_TITLE'),
                'description'   => 'Вы уверены что хотите удалить данную запись?',
            ]
        ]) ?>
    </div>

    <div class="box-body no-padding">
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'id',
            'title',
            'bg_image',
            'general_image',
            'alt_image',
            'announce',
            'text:ntext',
            'creation_date',
            'publication_date',
            'category_id',
            'seo_keywords',
            'seo_description',
            'canonical_url:url',
            'author_id',
            'status',
            'own_description',
            'created_at',
            'updated_at',
            ],
        ]) ?>
    </div>

</div>
