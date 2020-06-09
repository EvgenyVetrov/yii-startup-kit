<?php

use yii\widgets\ActiveForm;
use modules\site\Module;

/* @var $directory \modules\site\models\backend\Directory */
/* @var $model \modules\site\models\backend\UploadForm */

$this->title =  Module::t('filemanager', 'Upload files');
$this->params['pageTitle'] = $this->title;

if ( ! isset($this->params['breadcrumbs'])) {
    $this->params['breadcrumbs'] = [];
}

$this->params['breadcrumbs']   = array_merge($this->params['breadcrumbs'], $directory->getBreadcrumbs(false));
$this->params['breadcrumbs'][] = $this->title;
$this->params['content-fixed'] = true;
$this->params['place']         = 'file-manager';

?>

<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Загрузка в: &nbsp;<code style="background-color: #ffffff">&nbsp;<?= $directory->path ?>&nbsp;</code></h3>
        <!-- /.card-tools -->
    </div>
    <!-- /.card-header -->
    <div class="card-body">

        <div class="row">
            <div class="col-lg-6">
                <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>
                <?= $form->field($model, 'path')->label(false)->hiddenInput(['value' => $model->path]) ?>
                <?= $form->field($model, 'files[]')->fileInput(['multiple' => true]) ?>

                <div class="form-group">
                    <?= \yii\helpers\Html::submitButton(Module::t('filemanager', 'Upload'), ['class' => 'btn btn-success']) ?>
                </div>

                <?php ActiveForm::end() ?>

                <br>
                Фактическая директория загрузки на сервере: <br>
                <code><?= $directory->root ?><?= $directory->path ?></code>
                <br>

            </div>
            <div class="col-lg-6">
                <h4>Будьте осторожны!</h4>
                <p>Не загружайте неизвестные файлы, скрипты и исполняемые файлы. По возможности файлы не должны содержать
                спец-символы, а в идеальном случае и без пробелов должны быть (тире и подчеркивание вместо пробелов).</p>

                <p>Не загружайте конфиденциальные данные. Загруженный файл будет только на текущем сервере
                    и не попадет в систему контроля версий.</p>
            </div>
        </div>
    </div>
</div>
