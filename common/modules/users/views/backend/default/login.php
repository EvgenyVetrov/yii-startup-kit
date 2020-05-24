<?php

use yii\helpers\Url;
use yii\helpers\Html;
use modules\users\Module;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model \modules\users\models\frontend\forms\Login */

$this->title = Module::t('main', 'TITLE_LOGIN');
$this->params['breadcrumbs'][] = $this->title;
$assetPath = Yii::$app->assetManager->getPublishedUrl(Yii::$app->params['assetPath']);
?>

<div class="login-box">
    <div class="login-logo">
        <a href="/">
            <b class="white-text">
                <?= Yii::$app->name ?>
            </b>
        </a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">
                <?= Module::t('main', 'TITLE_LOGIN_DESCRIPTION') ?>
            </p>
            <?php if ($model->hasErrors()): ?>
                <div class="callout callout-danger">
                    <i class="icon fa fa-ban"></i>&nbsp;&nbsp;<?= current($model->getFirstErrors()) ?>
                </div>
            <?php endif; ?>

            <?php $form = ActiveForm::begin(); ?>

            <div class="input-group mb-3">
                <?= Html::activeTextInput($model, 'email', [
                    'class' => 'form-control',
                    'placeholder' => Module::t('main', 'ATTR_EMAIL')
                ]) ?>
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-envelope"></span>
                    </div>
                </div>
            </div>

            <div class="input-group mb-3">
                <?= Html::activePasswordInput($model, 'password', [
                    'class' => 'form-control',
                    'placeholder' => Module::t('main', 'ATTR_PASSWORD')
                ]) ?>
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                    </div>
                </div>
            </div>

                        <?= Html::submitButton(Module::t('main', 'BTN_LOGIN'), [
                            'class' => 'btn btn-primary btn-block btn-flat btn-loader',
                            'name' => 'login-button',
                        ]) ?>
            <?php ActiveForm::end(); ?>

        </div>
        <!-- /.login-card-body -->

    </div>

    <a href="/" class="pull-right text-white">
        <?= Module::t('main', 'TITLE_HOME') ?>
    </a>
</div>
<!-- /.login-box -->
