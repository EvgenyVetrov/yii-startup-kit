<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model modules\sitemap\models\backend\Sitemap */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Базовые записи sitemap', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['pageTitle']     = $this->title;

$this->params['content-fixed'] = true;
$this->params['pageIcon'] = 'list-ul';
$this->params['place']    = 'sitemap';
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
            'name',
            'loc',
            'lastmod',
            'changefreq',
            'priority',
            'own_description',
            'status',
            'created_at',
            'updated_at',
            ],
        ]) ?>
    </div>

</div>
