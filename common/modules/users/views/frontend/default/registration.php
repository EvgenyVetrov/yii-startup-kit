<?php

/* @var $this yii\web\View */
/* @var $model \modules\users\models\frontend\Users */

use yii\helpers\Url;
use yii\helpers\Html;
use modules\users\Module;
use yii\bootstrap\ActiveForm;
use himiklab\yii2\recaptcha\ReCaptcha;

$this->title = Module::t('main', 'TITLE_REGISTRATION');
$this->params['breadcrumbs'][] = $this->title;
$assetPath = Yii::$app->assetManager->getPublishedUrl(Yii::$app->params['assetPath']);
$this->params['place'] = 'registration';
?>


<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-10 col-lg-offset-1">
        <div class="card card-signup">
            <h2 class="card-title text-center">Регистрация пользователя</h2>
            <div class="row pl-sm-10 pr-sm-20">
                <div class="col-md-5 col-md-offset-1 col-sm-6">
                    <div class="card-content">
                        <div class="info info-horizontal">
                            <div class="icon icon-rose">
                                <i class="material-icons">timeline</i>
                            </div>
                            <div class="description">
                                <h4 class="info-title">Фирмы любых масштабов</h4>
                                <p class="description">
                                    Возможность регистрации группы компаний, головной организации, филиала, торговой точки, бригады/команды, в качестве самостоятельного мастера/фрилансера
                                </p>
                            </div>
                        </div>
                        <div class="info info-horizontal">
                            <div class="icon icon-primary">
                                <i class="material-icons">code</i>
                            </div>
                            <div class="description">
                                <h4 class="info-title">Несколько фирм у человека</h4>
                                <p class="description">
                                    Возможность привязки нескольких организаций/филиалов к одному лицу на случай когда у Вас несколько направлений деятельности.
                                </p>
                            </div>
                        </div>
                        <div class="info info-horizontal">
                            <div class="icon icon-info">
                                <i class="material-icons">group</i>
                            </div>
                            <div class="description">
                                <h4 class="info-title">Несколько человек в фирме</h4>
                                <p class="description">
                                    В процессе работы можно привязать несколько человек к одной организаци с разными ролями.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5 col-sm-6 pr-xs-30">
                    <?php $form = ActiveForm::begin(['id' => 'registration-form']); ?>
                        <div class="card-content pt-20">
                            <div class="row pl-20 pt-30">
                                <label class="col-xs-1 align-right pr-0 mr-0 mt-15">
                                    <i class="material-icons pull-right">face</i>
                                </label>
                                <div class="col-xs-11">
                                    <?= $form->field($model, 'first_name', [
                                        'options' => [
                                            'class'    => 'form-group label-floating mt-5'
                                        ],
                                    ])->textInput(['class' => 'form-control']); ?>
                                </div>
                            </div>

                            <div class="row pl-20 pt-30">
                                <label class="col-xs-1 align-right pr-0 mr-0 mt-15">
                                    <i class="material-icons pull-right">face</i>
                                </label>
                                <div class="col-xs-11">
                                    <?= $form->field($model, 'last_name', [
                                        'options' => [
                                            'class'    => 'form-group label-floating mt-5'
                                        ],
                                    ])->textInput(['class' => 'form-control']); ?>
                                </div>
                            </div>

                            <div class="row pl-20 pt-30">
                                <label class="col-xs-1 align-right pr-0 mr-0 mt-15">
                                    <i class="material-icons pull-right">email</i>
                                </label>
                                <div class="col-xs-11">
                                    <?= $form->field($model, 'email', [
                                        'options' => [
                                            'class'    => 'form-group label-floating mt-5'
                                        ],
                                    ])->textInput(['class' => 'form-control']); ?>
                                </div>
                            </div>

                            <div class="row pl-20 pt-30">
                                <label class="col-xs-1 align-right pr-0 mr-0 mt-15">
                                    <i class="material-icons pull-right">lock</i>
                                </label>
                                <div class="col-xs-11">
                                    <?= $form->field($model, 'password', [
                                        'options' => [
                                            'class'    => 'form-group label-floating mt-5'
                                        ],
                                    ])->passwordInput(['class' => 'form-control']); ?>
                                </div>
                            </div>

                            <div class="row pl-20 pt-30">
                                <label class="col-xs-1 align-right pr-0 mr-0 mt-15">
                                    <i class="material-icons pull-right">lock</i>
                                </label>
                                <div class="col-xs-11">
                                    <?= $form->field($model, 'password_repeat', [
                                        'options' => [
                                            'class'    => 'form-group label-floating mt-5'
                                        ],
                                    ])->passwordInput(['class' => 'form-control']); ?>
                                </div>
                            </div>


                            <!-- If you want to add a checkbox to this form, uncomment this code -->
                            <div class="checkbox">
                                <label class="pl-0 ml-10">
                                    <input type="checkbox" id="terms-agree" > Я согласен(сна) с
                                    <a href="/policy">правилами сервиса</a>.
                                </label>
                            </div>
                        </div>
                        <div class="footer text-center">
                            <button id="submit-reg-form-btn" type="submit" class="btn btn-primary btn-round disabled" disabled >начать работу</button>
                        </div>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php

/* простейшая реакция на выставление чекбокса согласия с условиями */
$script = <<<JS
    $("#terms-agree").on('click', function() {
        if ($("#terms-agree").prop("checked")) {
            $('#submit-reg-form-btn').removeClass('disabled').attr('disabled', false);
        } else {
            $('#submit-reg-form-btn').addClass('disabled').attr('disabled', true);
        }
    });

JS;

$this->registerJs($script);