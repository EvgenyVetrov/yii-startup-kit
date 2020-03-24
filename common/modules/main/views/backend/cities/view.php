<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model modules\main\models\backend\Cities */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Населенные пункты', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['pageTitle']     = $this->title;

$this->params['content-fixed'] = true; /* фиксируем ширину */
$this->params['place'] = 'cities';
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
        <?= Html::a('<i class="fa fa-plus"></i> Добавить новый', ['create'], ['class' => 'btn btn-primary']) ?>
    </div>

    <div class="box-body no-padding">
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'id',
            'form',
            'name',
            'area',
            'district_id',
            'population',
            'sort',
            'status',
            'created_at:datetime',
            'updated_at:datetime',
            ],
        ]) ?>
    </div>

</div>
