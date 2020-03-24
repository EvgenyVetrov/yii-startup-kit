<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model modules\feedback\models\backend\Feedback */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Список обращений', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['pageTitle']     = $this->title;

$this->params['place']     = 'feedback';
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
                'email:email',
                'org_id',
                [
                    'label' => 'Тип обращения',
                    'value' => $model::TYPE_LABELS[$model->type]
                ],
                [
                    'label' => 'Объект',
                    'value' => $model::OBJECT_TYPES[$model->object]['name']
                ],
                [
                    'label'  => 'ID объекта',
                    'format' => 'html',
                    'value'  => $model->object_id ? $model->object_id : '<span class="text-muted">(не задан)</span>'
                ],
                'text',
                'ip',
                'user_agent',
                [
                    'format' => 'html',
                    'label'  => 'Информация об&nbsp;устройстве',
                    'value'  => '<pre>'
                        . json_encode(json_decode($model->device_info, true),  JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES )
                        . '</pre>',
                ],
                'own_description',
                [
                    'label' => 'Статус',
                    'value' => $model::STATUS_LABELS[ (int) $model->status]
                ],
                [
                    'format' => 'html',
                    'label' => 'Создано',
                    'value' => date('d.m.Y &\nb\sp;h:i', $model->created_at)
                ],
                [
                    'format' => 'html',
                    'label' => 'Обновлено',
                    'value' => date('d.m.Y &\nb\sp;h:i', $model->updated_at)
                ],
            ],
        ]) ?>
    </div>

</div>
