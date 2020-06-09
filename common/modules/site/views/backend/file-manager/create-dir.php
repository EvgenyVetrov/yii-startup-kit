<?php

use yii\widgets\ActiveForm;
use modules\site\Module;

/* @var $this yii\web\View */
/* @var $model \modules\site\models\backend\DirectoryForm */
/* @var $directory \modules\site\models\backend\Directory */

$this->title = Module::t('filemanager', 'Create directory');
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
        <h3 class="card-title">Создание в: &nbsp;<code style="background-color: #ffffff">&nbsp;<?= $directory->path ?>&nbsp;</code></h3>
        <!-- /.card-tools -->
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="directory-form">
                    <?php $form = ActiveForm::begin(); ?>
                    <?= $form->field($model, 'path')->label(false)->hiddenInput(['value' => $model->path]) ?>
                    <?= $form->field($model, 'name')->textInput() ?>

                    <div class="form-group">
                        <?= \yii\helpers\Html::submitButton(Module::t('filemanager', 'Save'), ['class' => 'btn btn-success']) ?>
                    </div>

                    <?php ActiveForm::end(); ?>

                    <br>
                    Фактическая директория создания на сервере: <br>
                    <code><?= $directory->root ?><?= $directory->path ?></code>
                    <br>
                </div>
            </div>
            <div class="col-md-6">
                <h4>Будьте внимательны!</h4>
                <p>По возможности директория не должна содержать в названии спец-символы, а в идеальном случае и пробелов
                    не должно быть (тире и подчеркивание вместо пробелов).</p>

                <p>Созданная директория будет создана только на текущем сервере и не попадет в систему контроля версий.</p>
            </div>
        </div>
    </div>
</div>
