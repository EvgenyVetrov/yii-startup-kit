<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model modules\site\models\backend\PagesBlocks */
?>


<?php $form = ActiveForm::begin(); ?>

<div class="card card-primary card-outline">
    <div class="card-body">

            <div class="row">
                <div class="col-md-6">
                    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-6">
                    <?= $form->field($model, 'alias')->textInput(['maxlength' => true])
                    ->hint('Например "general-contact-info". По этому адиасу будет связан блок с хардкодной страницей.')?>
                </div>
                <div class="col-md-6">
                    <?= $form->field($model, 'own_description')->textarea(['maxlength' => true, 'rows' => 3]) ?>
                </div>
                <div class="col-md-6">
                    <?= $form->field($model, 'status')->dropDownList( \modules\site\models\BasePagesBlocks::statusLabels(), [
                        'class'  => 'form-control select2',
                        'style'  => 'width: 100%;',
                    ])->hint('Блок со статусом "черновик" не отображается') ?>
                </div>
                <div class="col-md-12">
                    <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>
                    <div id="ace-editor"></div>
                    <br>
                    <br>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'BTN_CREATE') : Yii::t('app', 'BTN_UPDATE'),
                        ['class' => 'btn btn-primary']
                    ) ?>
                    </div>
                </div>
            </div>
    </div>
</div>

<?php ActiveForm::end();


// только на этой странице нужен такой редактор, поэтому в общие ассеты его не включаем
//$this->registerJsFile($assetPath . '/plugins/ace-editor/ace.js', [\yii\web\View::POS_END]);
$this->registerJsFile('https://cdnjs.cloudflare.com/ajax/libs/ace/1.4.10/ace.js', [\yii\web\View::POS_BEGIN]);
$this->registerJsFile('https://cdnjs.cloudflare.com/ajax/libs/ace/1.4.10/ext-static_highlight.js', [\yii\web\View::POS_BEGIN]);
$this->registerJsFile('https://cdnjs.cloudflare.com/ajax/libs/ace/1.4.10/mode-html.js', [\yii\web\View::POS_BEGIN]);
$this->registerJsFile('https://cdnjs.cloudflare.com/ajax/libs/ace/1.4.10/theme-tomorrow_night.js', [\yii\web\View::POS_BEGIN]);

$script = <<<JS
    var html_editor = ace.edit("ace-editor", {
        theme: "ace/theme/tomorrow_night",
        mode: 'ace/mode/html',
        fontSize: "12pt",
        autoScrollEditorIntoView: true,
        maxLines: 40,
        minLines: 20
    });
    var textarea = $('textarea[name="PagesBlocks[content]"]').hide();
    html_editor.setTheme("ace/theme/tomorrow_night");
    html_editor.getSession().setMode("ace/mode/html");
    html_editor.setShowPrintMargin(false);
    html_editor.getSession().setValue(textarea.val());
    html_editor.getSession().on('change', function(){
      textarea.val(html_editor.getSession().getValue());
    });
    
    
JS;

$this->registerJs($script);
