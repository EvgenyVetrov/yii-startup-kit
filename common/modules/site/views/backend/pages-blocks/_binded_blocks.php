<?php
/**
 * Created by PhpStorm.
 * User: evetrov
 * Date: 30.05.20
 * Time: 20:46
 *
 * @var $this \yii\web\View
 * @var $dropdownBlocks array
 */


?>

<h3>Блоки, привязанные к странице</h3>
<div class="row pb-3">
    <div class="col-md-8">
        <?= \yii\helpers\Html::dropDownList('added_block', 'null', $dropdownBlocks, [
            'class'  => 'form-control select2',
            'id'     => 'add-block-selector',
            'style'  => 'width: 100%;',
        ]); ?>

    </div>
    <div class="col-md-4">
        <?= \yii\helpers\Html::button('<i class="fa fa-plus"></i> Добавить блок', [
            'class' => 'btn btn-primary',
            'id'    => 'add-block-btn'
        ]) ?>
    </div>
</div>

<?= \yii\grid\GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        'id',
        'name',
        'alias',
        [
            'class'    => 'yii\grid\ActionColumn',
            'template' => '<div class="text-right">{update} {delete}</div>',
            'buttons'  => [
                'update' => function ($url, $model, $key) {
                    return \yii\helpers\Html::a('<i class="fa fa-edit"></i> ' /*. Yii::t('app', 'BTN_UPDATE')*/, $url, [
                        'class'     => 'btn btn-xs btn-warning',
                        'title'     => Yii::t('app', 'BTN_UPDATE'),
                        'data-pjax' => 0,
                    ]);
                },
                'delete' => function ($url, $model, $key) {
                    return '
                    <span class="btn btn-xs btn-danger"  
                            title="Отвязать блок от страницы" 
                            data-pjax="0" 
                            data-block-id="'.$model->id.'"
                            data-action="delete-page-block"  >
                                <i class="fa fa-times"></i>
                    </span>
                    ';
                },
            ]
        ],
    ],
]);

$js = <<<JS
$('.select2').select2({
    minimumResultsForSearch: 10
});
JS;

$this->registerJs($js);


