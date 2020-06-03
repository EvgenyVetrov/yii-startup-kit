<?php

use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model \modules\site\models\backend\DirectoryForm */
/* @var $directory \modules\site\models\backend\Directory */

$this->title = \modules\site\Module::t('filemanager', 'Rename directory');
$this->params['pageTitle'] = $this->title;

if ( ! isset($this->params['breadcrumbs'])) {
    $this->params['breadcrumbs'] = [];
}

$this->params['breadcrumbs'] = array_merge($this->params['breadcrumbs'], $directory->getBreadcrumbs(false));
$this->params['breadcrumbs'][] = $this->title;

?>


<div class="row">
    <div class="col-lg-4">
        <div class="directory-form">
            <?php $form = ActiveForm::begin(); ?>
            <?= $form->field($model, 'path')->label(false)->hiddenInput(['value' => $model->path]) ?>
            <?= $form->field($model, 'name')->label(false)->hiddenInput(['value' => $model->name]) ?>
            <?= $form->field($model, 'newName')->textInput() ?>

            <div class="form-group">
                <?= \yii\helpers\Html::submitButton(\modules\site\Module::t('filemanager', 'Save'), ['class' => 'btn btn-success']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>