<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model modules\site\models\backend\Pages */
?>


<?php $form = ActiveForm::begin(); ?>

<div class="card card-primary <?= $model->isNewRecord ? '' : 'collapsed-card' ?>">
    <div class="card-header">
        <h3 class="card-title">Общие данные</h3>

        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-<?= $model->isNewRecord ? 'minus' : 'plus' ?>"></i>
            </button>
        </div>
        <!-- /.card-tools -->
    </div>
    <!-- /.card-header -->
    <div class="card-body" style="display: <?= $model->isNewRecord ? 'block' : 'none' ?>;">
        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'name')->textInput(['maxlength' => true])
                    ->hint('Внутреннее название страницы для админки. Не отображается пользователям') ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'location')->textInput(['maxlength' => true])
                    ->hint('Адрес расположения страницы. Например "/about/team". 
                    Если есть системная страница с таким адресом, то отобразится именно она. Будте внимательнее 
                    при заполнении, чтобы не было пересекающихся адресов. Пересекающиеся адреса могут быть полезны для А/В тестирования.') ?>
            </div>

            <div class="col-md-6">
                <?= $form->field($model, 'type')->dropDownList( \modules\site\models\BasePages::typeLabels(), [
                    'class'  => 'form-control select2',
                    'style'  => 'width: 100%;',
                ])->hint('Хардкодная страница или виртуальная.<br><br>Хардкодная страница имеет свой контроллер, 
                        экшн и файл представления. Из данной настройки берутся только необходимые данные.<br>
                        Виртуальная страница не имеет сохраненнго кода и полностью отображается на основе данных из базы.') ?>

                <?= $form->field($model, 'status')->dropDownList( \modules\site\models\BasePages::statusLabels(), [
                    'class'  => 'form-control select2',
                    'style'  => 'width: 100%;',
                ])->hint('Страница со статусом "черновик" не отображается, если это виртуальная и не используется 
                в качестве данных для хардкодной страницы') ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'own_description')->textarea(['maxlength' => true, 'rows' => 5]) ?>
            </div>
        </div>
    </div>
    <!-- /.card-body -->
</div>

<div class="card card-success  <?= $model->isNewRecord ? '' : 'collapsed-card' ?>">
    <div class="card-header">
        <h3 class="card-title">Содержимое страницы</h3>

        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-<?= $model->isNewRecord ? 'minus' : 'plus' ?>"></i>
            </button>
        </div>
        <!-- /.card-tools -->
    </div>
    <div class="card-body" style="display: <?= $model->isNewRecord ? 'block' : 'none' ?>;">

            <div class="row">



                <div class="col-md-12">
                    <?= $form->field($model, 'content')->textarea(['rows' => 6])
                    ->hint('HTML содержимое страницы. Будте внимательны, это содержимое попадет на страницу без преобразований.')?>
                    <div id="ace-editor"></div>
                    <br>
                    <br>
                </div>
                <div class="col-md-12">
                    <?= $form->field($model, 'js')->textarea(['rows' => 6])
                    ->hint('JS скрипт, который будет добавлен на стрницу и сработает после события ready. Не добавляйте сюда незнакомые скрипты. Тег < script>  не нужен.')?>
                    <div id="ace-editor-js"></div>
                    <br>
                    <br>
                </div>


                <div id="page-blocks-container" class="col-md-12" >
                    Блоки можно привязать к странице после создания страницы.
                </div>



            </div>
    </div>
</div>

<div class="card card-warning  <?= $model->isNewRecord ? '' : 'collapsed-card' ?>">
    <div class="card-header">
        <h3 class="card-title">SEO</h3>

        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-<?= $model->isNewRecord ? 'minus' : 'plus' ?>"></i>
            </button>
        </div>
        <!-- /.card-tools -->
    </div>
    <div class="card-body" style="display: <?= $model->isNewRecord ? 'block' : 'none' ?>;">
        <div class="row">
            <div class="col-md-12">
                <?= $form->field($model, 'custom_head')->textarea(['rows' => 6]) ?>
                <div id="ace-editor-head"></div>
                <br>
                <br>
            </div>

            <div class="col-md-6">
                <?= $form->field($model, 'robots')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'keywords')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-md-6">                <?= $form->field($model, 'sitemap_lastmod')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-md-6">                <?= $form->field($model, 'sitemap_changefreq')->textInput() ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'sitemap_priority')->textInput() ?>
            </div>
        </div>

    </div>
</div>

    <div class="col-md-12">
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'BTN_CREATE') : Yii::t('app', 'BTN_UPDATE'),
                ['class' => 'btn btn-primary']
            ) ?>
        </div>
    </div>
    <br>

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
    var textarea = $('textarea[name="Pages[content]"]').hide();
    html_editor.setTheme("ace/theme/tomorrow_night");
    html_editor.getSession().setMode("ace/mode/html");
    html_editor.setShowPrintMargin(false);
    html_editor.getSession().setValue(textarea.val());
    html_editor.getSession().on('change', function(){
      textarea.val(html_editor.getSession().getValue());
    });
    
    
    
    var html_editor_js = ace.edit("ace-editor-js", {
        theme: "ace/theme/tomorrow_night",
        mode: 'ace/mode/html',
        fontSize: "12pt",
        autoScrollEditorIntoView: true,
        maxLines: 40,
        minLines: 20
    });
    var textarea_js = $('textarea[name="Pages[js]"]').hide();
    html_editor_js.setTheme("ace/theme/tomorrow_night");
    html_editor_js.getSession().setMode("ace/mode/html");
    html_editor_js.setShowPrintMargin(false);
    html_editor_js.getSession().setValue(textarea_js.val());
    html_editor_js.getSession().on('change', function(){
      textarea_js.val(html_editor_js.getSession().getValue());
    });
    
    
    var html_editor_head = ace.edit("ace-editor-head", {
        theme: "ace/theme/tomorrow_night",
        mode: 'ace/mode/html',
        fontSize: "12pt",
        autoScrollEditorIntoView: true,
        maxLines: 20,
        minLines: 10
    });
    var textarea_head = $('textarea[name="Pages[custom_head]"]').hide();
    html_editor_head.setTheme("ace/theme/tomorrow_night");
    html_editor_head.getSession().setMode("ace/mode/html");
    html_editor_head.setShowPrintMargin(false);
    html_editor_head.getSession().setValue(textarea_head.val());
    html_editor_head.getSession().on('change', function(){
      textarea_head.val(html_editor_head.getSession().getValue());
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
