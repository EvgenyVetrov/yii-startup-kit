<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model modules\users\models\backend\Profiles */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Профили', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['pageTitle']     = $this->title;

$this->params['pageIcon'] = 'user-o';
$this->params['place']    = 'profiles';
$this->params['content-fixed'] = true; /* фиксируем ширину */
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
            'user_id',
            'org_id',
            'json_contacts',
            'custom_contacts',
            'role',
            'position',
            'invite_status',
            'invite_date',
            'invite_user',
            'status',
            'own_description',
            'created_at:datetime',
            'updated_at',
            ],
        ]) ?>
    </div>

</div>
