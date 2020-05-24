<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model modules\blog\models\backend\BlogTags */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Теги для блога', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['pageTitle']     = $this->title;

$this->params['content-fixed'] = true;
$this->params['pageIcon'] = 'tags';
$this->params['place']    = 'blog-tags';
?>
<div class="card card-outline card-primary">
    <div class="card-header">
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

    <div class="card-body no-padding">
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'id',
            'name',
            'canonical_url:url',
            'seo_keywords',
            'seo_description',
            'bg_image',
            'own_description',
            'created_at',
            'updated_at',
            ],
        ]) ?>
    </div>

</div>
