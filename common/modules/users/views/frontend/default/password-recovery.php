<?php

use yii\helpers\Url;
use yii\helpers\Html;
use modules\users\Module;
use yii\bootstrap\ActiveForm;
use himiklab\yii2\recaptcha\ReCaptcha;

/* @var $this yii\web\View */
/* @var $model \modules\users\models\frontend\forms\PasswordRecovery */

Yii::$app->params['robots'] = 'none';

$this->title                   = Module::t('main', 'TITLE_PASSWORD_RECOVERY');
$this->params['breadcrumbs'][] = $this->title;
$assetPath                     = Yii::$app->assetManager->getPublishedUrl(Yii::$app->params['assetPath']);
$this->params['place']         = 'password-recovery';
?>

<div class="row">
    <div class="col-lg-4  col-md-6 col-sm-6 col-lg-offset-4 col-md-offset-3 col-sm-offset-3">
        <form method="#" action="#">
            <div class="card card-login card-hidden">
                <div class="card-header text-center" data-background-color="blue">
                    <h4 class="card-title">Восстановление пароля</h4>
                </div>
                <div class="card-content pt-30">
                    <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="material-icons">email</i>
                                            </span>
                        <div class="form-group label-floating">
                            <label class="control-label">Email address</label>
                            <input type="email" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="footer text-center pb-10">
                    <button class="btn btn-info btn-round">восстановить<div class="ripple-container"></div></button>
                </div>
            </div>
        </form>
    </div>
</div>






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
            <?= Module::t('main', 'TITLE_PASSWORD_RECOVERY') ?>
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

        <?php /*$form->field($model, 'captcha')->widget(ReCaptcha::className(), [
            'siteKey' => Yii::$app->reCaptcha->siteKey
        ])->label(false)*/ ?>

        <div class="row">
            <div class="col-xs-12">
                <?= Html::submitButton(Module::t('main', 'BTN_PASSWORD_RECOVERY'), [
                    'class' => 'btn btn-primary btn-block btn-flat',
                    'name' => 'login-button'
                ]) ?>
            </div>
        </div>

        <div class="menu">
            <a href="<?= Url::to(['/users/default/login']) ?>" class="text-center">
                <?= Module::t('main', 'TITLE_LOGIN') ?>
            </a>
            <a href="<?= Url::to(['/users/default/registration']) ?>" class="pull-right">
                <?= Module::t('main', 'TITLE_REGISTRATION') ?>
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