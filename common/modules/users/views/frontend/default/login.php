<?php

use yii\helpers\Url;
use yii\helpers\Html;
use modules\users\Module;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model \modules\users\models\frontend\forms\Login */
Yii::$app->params['robots'] = 'none';

$this->title                   = Module::t('main', 'TITLE_LOGIN');
$this->params['breadcrumbs'][] = $this->title;
$assetPath                     = Yii::$app->assetManager->getPublishedUrl(Yii::$app->params['assetPath']);
$this->params['place']         = 'login';
?>

<div class="row">
    <div class="col-lg-4  col-md-6 col-sm-6 col-lg-offset-4 col-md-offset-3 col-sm-offset-3">

            <div class="card card-login card-hidden">
                <div class="card-header text-center" data-background-color="blue">
                    <h4 class="card-title">Аутентификация</h4>
                </div>
                <?php $form = ActiveForm::begin(); ?>
                <div class="card-content pt-30">

                    <!--<div class="row pl-20">
                        <label class="col-xs-2 align-right pr-0 mr-0 mt-15">
                            <i class="material-icons pull-right">email</i>
                        </label>
                        <div class="col-xs-10">
                            <div class="form-group">
                                <div class="form-group label-floating">
                                    <label class="control-label">Email address</label>
                                    <input type="email" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>-->

                    <?php /*$form->beginField($model, 'email', ['options' => ['class' => 'input-group']]) */?><!--
                        <span class="input-group-addon">
                            <i class="material-icons">email</i>
                        </span>

                        <div class="form-group label-floating">
                            <label class="control-label">Email address</label>
                            <?php /*Html::activeTextInput($model, 'email') */?>
                            <?php /*Html::error($model, 'email', ['class' => 'help-block']) */?>
                        </div>
                    --><?php /*$form->endField() */?>

                    <div class="row pl-20">
                        <label class="col-xs-2 align-right pr-0 mr-0 mt-15">
                            <i class="fas fa-envelope pull-right text-21"></i>
                        </label>
                        <div class="col-xs-10">
                            <?= $form->field($model, 'email', [
                                'options' => [
                                    'class'    => 'form-group label-floating'
                                ],
                            ])->textInput(['class' => 'form-control']); ?>
                        </div>
                    </div>

                    <div class="row pl-20 pt-20">
                        <label class="col-xs-2 align-right pr-0 mr-0 mt-15">
                            <i class="fas fa-key pull-right text-21"></i>
                        </label>
                        <div class="col-xs-10">
                            <?= $form->field($model, 'password', [
                                'options' => [
                                    'class'    => 'form-group label-floating'
                                ],
                            ])->passwordInput(['class' => 'form-control']); ?>
                        </div>
                    </div>





<!--                    <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">email</i>
                                            </span>
                        <div class="form-group label-floating">
                            <label class="control-label">Email address</label>
                            <input type="email" class="form-control">
                        </div>
                    </div>
                    <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">lock_outline</i>
                                            </span>
                        <div class="form-group label-floating">
                            <label class="control-label">Password</label>
                            <input type="password" class="form-control">
                        </div>
                    </div>-->
                </div>
                <div class="footer text-center pb-10">
                    <button class="btn btn-info btn-round mt-20">
                        войти
                    </button>
                </div>
                <?php ActiveForm::end(); ?>
            </div>

    </div>
</div>

<?php if (false): ?>
    <hr>
    <hr>
    <hr>
    <div class="login-box">
        <div class="login-logo">
            <a href="/">
                <b>
                    <?= Yii::$app->name ?>
                </b>
            </a>
        </div><!-- /.login-logo -->
        <div class="login-box-body">
            <p class="login-box-msg">
                <?= Module::t('main', 'TITLE_LOGIN_DESCRIPTION') ?>
            </p>

            <?php if ($model->hasErrors()): ?>
                <div class="callout callout-danger">
                    <i class="icon fa fa-ban"></i>&nbsp;&nbsp;<?= current($model->getFirstErrors()) ?>
                </div>
            <?php endif; ?>
            <?php $form = ActiveForm::begin(); ?>


            <div class="form-group has-feedback">
                <?= Html::activeTextInput($model, 'email', [
                    'class' => 'form-control',
                    'placeholder' => Module::t('main', 'ATTR_EMAIL')
                ]) ?>
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <?= Html::activePasswordInput($model, 'password', [
                    'class' => 'form-control',
                    'placeholder' => Module::t('main', 'ATTR_PASSWORD')
                ]) ?>
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>

            <div class="row">
                <div class="col-xs-12">
                    <?= Html::submitButton(Module::t('main', 'BTN_LOGIN'), [
                        'class' => 'btn btn-primary btn-block btn-flat btn-loader',
                        'name' => 'login-button',
                    ]) ?>
                </div>
            </div>

            <div class="menu">
                <a href="<?= Url::to(['/users/default/registration']) ?>" class="text-center">
                    <?= Module::t('main', 'TITLE_REGISTRATION') ?>
                </a>
                <a href="<?= Url::to(['/users/default/password-recovery']) ?>" class="pull-right">
                    <?= Module::t('main', 'PASSWORD_RECOVERY') ?>
                </a>
            </div>

            <?php ActiveForm::end(); ?>

        </div><!-- /.login-box-body -->

        <div class="policy">
            <a href="/" class="pull-left">
                <?= Module::t('main', 'TITLE_HOME') ?>
            </a>
            <a href="#" data-toggle="modal" data-target="#modal-policy" class="pull-right">
                <?= Module::t('main', 'TITLE_POLICY') ?>
            </a>
        </div>

    </div><!-- /.login-box -->
<?php endif; ?>

