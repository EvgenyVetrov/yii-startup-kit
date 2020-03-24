<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model modules\blog\models\backend\BlogPosts */

$assetPath = Yii::$app->assetManager->getPublishedUrl(Yii::$app->params['assetPath']);
?>


<?php $form = ActiveForm::begin(); ?>

<div class="box">
    <div class="box-body">
            <div class="row">
                <div class="col-md-6">
                    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-6">
                    <?= $form->field($model, 'canonical_url')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-4">
                    <?= $form->field($model, 'bg_image')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-4">
                    <?= $form->field($model, 'general_image')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-4">
                    <?= $form->field($model, 'alt_image')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-6">
                    <?= $form->field($model, 'announce')->textarea(['maxlength' => true, 'rows' => 4]) ?>
                </div>
                <div class="col-md-6">
                    <?= $form->field($model, 'creation_date', [
                        'labelOptions' => [
                            'class' => 'label-control'
                        ],
                        'inputOptions' => [
                            'class' => 'form-control datepicker'
                        ]
                    ])->textInput() ?>

                    <?= $form->field($model, 'publication_date', [
                        'labelOptions' => [
                            'class' => 'label-control'
                        ],
                        'inputOptions' => [
                            'class' => 'form-control datepicker'
                        ]
                    ])->textInput() ?>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <?= $form->field($model, 'text', ['options' => ['class' => '']])->textarea(['rows' => 6]) ?>
                    <div id="ace-editor"></div>
                    <br>
                    <br>
                </div>

                <div class="col-md-6">
                    <?= $form->field($model, 'category_id')
                        ->dropDownList( ['0' => 'не выбрана'] + \modules\blog\models\BaseBlogCategories::valuesAll() ,
                            [
                                'class'  => 'form-control select2',
                                'style'  => 'width: 100%;',
                            ]) ?>
                </div>
                <div class="col-md-6">
                    <?= $form->field($model, 'author_id')->textInput() ?>
                </div>
                <div class="col-md-4"></div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <?= $form->field($model, 'seo_keywords')->textarea(['maxlength' => true]) ?>
                </div>
                <div class="col-md-6">
                    <?= $form->field($model, 'seo_description')->textarea(['maxlength' => true]) ?>
                </div>

                <div class="col-md-6">
                    <?= $form->field($model, 'status')->dropDownList( \modules\blog\models\BaseBlogPosts::statusLabels() , [
                        'class'  => 'form-control select2',
                        'style'  => 'width: 100%;',
                    ]) ?>

                </div>
                <div class="col-md-6">
                    <?= $form->field($model, 'own_description')->textarea(['maxlength' => true]) ?>
                </div>

            </div>
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'BTN_CREATE') : Yii::t('app', 'BTN_UPDATE'),
                ['class' => 'btn btn-primary']
            ) ?>
        </div>
    </div>
</div>

<?php ActiveForm::end();

// только на этой странице нужен такой редактор, поэтому в общие ассеты его не включаем
//$this->registerJsFile($assetPath . '/plugins/ace-editor/ace.js', [\yii\web\View::POS_END]);
$this->registerJsFile('https://cdnjs.cloudflare.com/ajax/libs/ace/1.4.3/ace.js', [\yii\web\View::POS_BEGIN]);
$this->registerJsFile('https://cdnjs.cloudflare.com/ajax/libs/ace/1.4.3/ext-static_highlight.js', [\yii\web\View::POS_BEGIN]);
$this->registerJsFile('https://cdnjs.cloudflare.com/ajax/libs/ace/1.4.3/mode-html.js', [\yii\web\View::POS_BEGIN]);
$this->registerJsFile('https://cdnjs.cloudflare.com/ajax/libs/ace/1.4.3/theme-tomorrow_night.js', [\yii\web\View::POS_BEGIN]);

$script = <<<JS
    var html_editor = ace.edit("ace-editor", {
        theme: "ace/theme/tomorrow_night",
        mode: 'ace/mode/html',
        autoScrollEditorIntoView: true,
        maxLines: 40,
        minLines: 20
    });
    var textarea = $('textarea[name="BlogPosts[text]"]').hide();
    html_editor.setTheme("ace/theme/tomorrow_night");
    html_editor.getSession().setMode("ace/mode/html");
    html_editor.setShowPrintMargin(false);
    html_editor.getSession().setValue(textarea.val());
    html_editor.getSession().on('change', function(){
      textarea.val(html_editor.getSession().getValue());
    });

    /*var editor = ace.edit("blogposts-text", {
        theme: "ace/theme/tomorrow_night",
        mode: 'ace/mode/html',
        autoScrollEditorIntoView: true,
        maxLines: 40,
        minLines: 20
    });*/
    
JS;

$this->registerJs($script);

