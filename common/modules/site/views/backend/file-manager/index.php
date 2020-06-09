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
                $options = [];
                $isFile = false;
                if ($item instanceof File) {
                    $isFile               = true;
                    $options['download']  = true;
                    $options['data-pjax'] = 0;
                }

                return Html::a('<i class="'.$item->icon.' fa-fw mr-2"></i>'. $item->name,
                        $isFile ? $item->url : ['index', 'path' => $item->path],
                        $options);
            },
            'format'    => 'raw'
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
            'buttons' => [
                'copypaste' => function ($url, $model, $key) {

                if (!isset($model->scenario)) { return false; }
                if ($model instanceof Directory) { return false; }
                $url = $model->url;
                    return '
                    <span class="btn btn-xs btn-info"  
                            title="Скопировать ссылку на файл" 
                            data-pjax="0"
                            data-action-type="url"
                            data-action="copypaste"
                            data-origin-url=""
                            data-result-text="<code>'.$url.'</code>" 
                            data-copy="'.$url.'" 
                            data-action-title="Скопировать">
                                <i class="fas fa-link"></i>
                    </span>
                    ';


                    /*return Html::a('<i class="fa fa-times"></i> ' . Yii::t('app', 'BTN_DELETE'), $url, [
                        'class' => 'btn btn-xs btn-danger', 'data-method' => 'post',
                        'title' => Yii::t('app', 'BTN_DELETE'),
                        'data'  => [
                            'pjax'           => 0,
                            'action'         => 'confirm',
                            'action-url'     => $url,
                            'action-title'   => Yii::t('app', 'CONFIRM_DELETE'),
                        ],
                    ]);*/
                },
                'update' => function ($url, $model, $key) {
                    if (!isset($model->scenario)) { return false; }
                    return Html::a('<i class="fa fa-edit"></i> ' /*. Yii::t('app', 'BTN_UPDATE')*/, $url, [
                        'class'     => 'btn btn-xs btn-warning',
                        'title'     => Yii::t('app', 'BTN_UPDATE'),
                        'data-pjax' => 0,
                    ]);
                },
                'delete' => function ($url, $model, $key) {

                if (!isset($model->scenario)) { return false; }

                $url = \yii\helpers\Url::to($url);
                    return '
                    <span class="btn btn-xs btn-danger"  
                            title="'.Yii::t('app', 'BTN_DELETE').'" 
                            data-method="post" 
                            data-pjax="0" 
                            data-action="confirmation" 
                            data-action-url="'.$url.'" 
                            data-action-title="'.Yii::t('app', 'CONFIRM_DELETE').'">
                                <i class="fa fa-times"></i>
                    </span>
                    ';


                    /*return Html::a('<i class="fa fa-times"></i> ' . Yii::t('app', 'BTN_DELETE'), $url, [
                        'class' => 'btn btn-xs btn-danger', 'data-method' => 'post',
                        'title' => Yii::t('app', 'BTN_DELETE'),
                        'data'  => [
                            'pjax'           => 0,
                            'action'         => 'confirm',
                            'action-url'     => $url,
                            'action-title'   => Yii::t('app', 'CONFIRM_DELETE'),
                        ],
                    ]);*/
                }
            ],
            'template' => '<div class="text-right">{copypaste} {update} {delete}</div>'
        ],
    ],
]);

?>
    </div>
</div>
<?php \yii\widgets\Pjax::end(); ?>
