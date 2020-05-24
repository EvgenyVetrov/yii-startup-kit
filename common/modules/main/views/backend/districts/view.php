<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/**
 * @var $model modules\main\models\backend\Districts
 * @var $countAllCities integer
 * @var $countActiveCities integer
 */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Библиотека областей', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['pageTitle']     = $this->title;

$this->params['content-fixed'] = true; /* фиксируем ширину */
$this->params['place'] = 'districts';
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
                'country_id',
                'name',
                'code',
                'status',
                'created_at:datetime',
                'updated_at:datetime',
                'sort',
                [
                    'label' => 'Городов в области',
                    'value' => $countAllCities
                ],
                [
                    'label' => 'Активных городов',
                    'value' => $countActiveCities
                ]
            ],
        ]) ?>
    </div>

</div>
