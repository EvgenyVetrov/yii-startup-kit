<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Права доступа';
$this->params['pageTitle'] = $this->title;
$this->params['pageIcon'] = 'unlock-alt';
$this->params['place'] = 'rbac';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="card card-outline card-primary">

    <?= Html::beginForm(['delete-multiple']); ?>

    <div class="card-header">
        <?= Html::a('<i class="fa fa-plus"></i> Добавить', ['create'], [
            'class' => 'btn btn-primary'
        ]) ?>
        <?= Html::submitButton('<i class="fa fa-times"></i> Удалить', [
            'class' => 'btn btn-danger'
        ]) ?>
    </div>

    <div class="card-body no-padding">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                ['class' => 'yii\grid\CheckboxColumn'],
                [
                    'label' => 'Алиас',
                    'attribute' => 'name',
                ],
                [
                    'label' => 'Описание',
                    'attribute' => 'description',
                ],
                [
                    'class' => \yii\grid\ActionColumn::class,
                    'template' => '{view} {update}',
                ],
            ]
        ]) ?>
    </div>

    <?= Html::endForm(); ?>

</div>