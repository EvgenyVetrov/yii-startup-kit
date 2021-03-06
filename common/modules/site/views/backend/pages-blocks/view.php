<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model modules\site\models\backend\PagesBlocks */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Блоки страниц', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['pageTitle']     = $this->title;

$this->params['content-fixed'] = true;
$this->params['pageIcon']      = 'fas fa-sitemap';
$this->params['place']         = 'site-pages-blocks';
?>
<div class="card card-primary card-outline">
    <div class="card-header">
        <?= Html::a('<i class="fas fa-edit"></i> Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
        <?= Html::a('<i class="fas fa-times"></i> Удалить', ['delete', 'id' => $model->id],
        [
            'class' => 'btn btn-danger',
            'data'  => [
                'title'        => Yii::t('app', 'BTN_DELETE'),
                'method'       => "post",
                'pjax'         => 0,
                'action'       => "confirmation",
                'action-url'   => Url::to(['delete', 'id' => $model->id]),
                'action-title' => Yii::t('app', 'CONFIRM_DELETE')
            ]
        ]) ?>
    </div>

    <div class="card-body no-padding">
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'id',
            'name',
            'alias',
            'content:ntext',
            'own_description',
            'status',
            'created_at:datetime',
            'updated_at:datetime',
            ],
        ]) ?>
    </div>

</div>
