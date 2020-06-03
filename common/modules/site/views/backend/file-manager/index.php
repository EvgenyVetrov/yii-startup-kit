<?php

use yii\helpers\Html;
use modules\site\models\backend\Directory;
use modules\site\models\backend\File;
use modules\site\models\backend\Item;
use modules\site\Module;

/** @var \yii\data\ArrayDataProvider $dataProvider */
/** @var Directory $directory */

//\DeLuxis\Yii2SimpleFilemanager\assets\Asset::register($this);

$this->title = Module::t('filemanager', 'File manager');
$this->params['pageTitle']     = $this->title;

if ( ! isset($this->params['breadcrumbs'])) {
    $this->params['breadcrumbs'] = [];
}

if ($directory->isRoot) {
    $this->params['breadcrumbs'][] = $this->title;
} else {
    $this->params['breadcrumbs'] = array_merge($this->params['breadcrumbs'], $directory->breadcrumbs);
    $this->title                .= ' ' . $directory->name;
}

$this->params['place']    = 'file-manager';

?>
<?php \yii\widgets\Pjax::begin(); ?>
<div class="pages-index card card-primary">

    <div class="card-header">
        <div class="simple-filemanager">
                <?= Html::a('<i class="far fa-folder fa-fw"></i> ' . Module::t('filemanager', 'Create directory'),
                    ['file-manager/create', 'path' => $directory->path],
                    ['class' => 'btn btn-success']) ?>
                <?= Html::a('<i class="fas fa-upload fa-fw"></i> ' . Module::t('filemanager', 'Upload files'),
                    ['file-manager/upload', 'path' => $directory->path],
                    ['class' => 'btn btn-primary']) ?>

        </div>
    </div>
    <div class="card-body no-padding">
<?php

echo \yii\grid\GridView::widget([
    'dataProvider' => $dataProvider,
    'columns'      => [
        [
            'class'     => 'yii\grid\DataColumn',
            'attribute' => 'name',
            'value'     => function ($item) {
                return Html::a('<i class="'.$item->icon.' fa-fw mr-2"></i>'. $item->name,
                        $item instanceof File ? $item->url : ['index', 'path' => $item->path]);
            },
            'format'    => 'html'
        ],
        [
            'class' => 'yii\grid\DataColumn',
            'label' => Module::t('filemanager', 'Path'),
            'attribute' => 'path',
            'value' => function($item){
                return $item instanceof File ? '<code>'.$item->path. '</code>' : '';
            },
            'format'    => 'html'
        ],
        [
            'class' => 'yii\grid\DataColumn',
            'headerOptions'  => ['class' => 'col-xs-1'],
            'label' => Module::t('filemanager', 'Size'),
            'attribute' => 'size',
            'value' => function($item){
                return $item instanceof File ? \Yii::$app->formatter->asShortSize($item->size) : '';
            }
        ],
        [
            'class'          => 'yii\grid\ActionColumn',
            'headerOptions'  => ['class' => 'col-xs-1'],
            'urlCreator'     => function ($action, $model) {
                return [
                    'file-manager/' . $action,
                    'path' => $model->path
                ];
            },
            'visibleButtons' => [
                'view'   => function ($model) {
                    return false;
                },
                'update' => function ($model) {
                    return $model instanceof Directory;
                },
                'delete' => function ($url, $model) {
                    return $model instanceof Item;
                }
            ]
        ],
    ],
]);

?>
    </div>
</div>
<?php \yii\widgets\Pjax::end(); ?>
