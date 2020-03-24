<?php
/**
 * Блок контактов на странице "О нас" в морде сайта
 *
 * @var $this \yii\web\View
 * @var $model \modules\feedback\models\frontend\Feedback
 */

use common\components\ActiveForm;


?>

<div class="container pt-40 pb-40 contact-page">
    <h2 class="title">Отправить сообщение</h2>
    <div class="row">
        <div class="col-md-6">
            <p class="description">
                Все сообщения обязательно будут прочтены и приняты к сведению или в работу. Не всегда получается ответить, но мы постараемся.
                <br><br>
            </p>
            <?php
            $form = ActiveForm::begin([
                'id' => 'contact-form'
            ]) ?>

            <?php

            $params = [
                'class' => 'selectpicker',
                'data-style' => 'select-with-transition',
                'title' => 'C чем связано обращение:',
                'data-size' => 7,
                'options' => [
                        '99' =>['disabled' => true]
                ]
            ];
            echo $form->field($model, 'type')
                ->dropDownList(['99' => 'Тип обращения:'] + $model->formedTypeList,$params)
                ->label(false);

            ?>

                <?= $form->field($model, 'email')
                    ->label(null,  ['class' => 'bmd-label-floating control-label'])
                    ->error(['class' => 'help-block text-12']) ?>

            <?= $form->field($model, 'text')
                ->textarea(['maxlength' => true, 'rows' => 7])
                ->label(null,  ['class' => 'bmd-label-floating control-label form-control-label bmd-label-floating'])
                ->error(['class' => 'help-block text-12']) ?>

            <div class="ml-auto mr-auto">
                <?= $form->field($model, 'reCaptcha')->widget(
                    \himiklab\yii2\recaptcha\ReCaptcha::className(),
                    ['siteKey' => Yii::$app->params['recaptcha']['key'], /*'size' => 'invisible'*/]
                )->label(false) ?>
            </div>

            <?= $form->field($model, 'device_info', ['options' => ['id' => 'device-info']])
                ->hiddenInput()
                ->label(false) ?>


                <div id="submit-btn-block" class="submit text-center">
                    <input type="submit" class="btn btn-primary btn-raised btn-round" value="отправить">
                </div>
            <?php ActiveForm::end() ?>
        </div>
        <div class="col-md-4 ml-auto">
            <div class="info info-horizontal">
                <div class="icon icon-primary">
                    <i class="material-icons">pin_drop</i>
                </div>
                <div class="description">
                    <h4 class="info-title">Местонахождение</h4>
                    <p> Россия, Санкт-Петербург
                    </p>
                </div>
            </div>
            <div class="info info-horizontal">
                <div class="icon icon-primary">
                    <i class="fab fa-telegram"></i>
                </div>
                <div class="description">
                    <h4 class="info-title">Telegram</h4>
                    <p>
                        <a href="https://tglink.ru/zakupator" target="_blank">@zakupator</a> - официальный чат для обсуждений
                    </p>
                </div>
            </div>
            <div class="info info-horizontal">
                <div class="icon icon-primary">
                    <i class="fab fa-vk"></i>
                </div>
                <div class="description">
                    <h4 class="info-title">Вконтакте</h4>
                    <p>
                        <a href="https://vk.com/zakupator_org" target="_blank">vk.com/zakupator_org</a> - официальная группа ВК
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>


<?php


$script = <<<JS


navigator.getBattery().then(function(battery) {
  function updateAllBatteryInfo(){
    updateChargeInfo();
    updateLevelInfo();
  }
  updateAllBatteryInfo();


  function updateChargeInfo(){
    window.batteryCharging = battery.charging;
  }

  function updateLevelInfo(){
    window.batteryLevel = battery.level * 100 + "%";
  }

});
    var connection = window.navigator.connection;

    setTimeout(function() {
        var deviceInfoObj = {
            platform: window.navigator.platform,
            language: window.navigator.language,
            app_version: window.navigator.appVersion,
            screen_height: screen.height,
            screen_width: screen.width,
            client_height: document.body.clientHeight,
            client_width: document.body.clientWidth,
            pixel_ratio: window.devicePixelRatio,
            client_time: Date(),
            battery_charging: window.batteryCharging,
            battery_level: window.batteryLevel,
            connection_effective_type: connection.effectiveType,
            connection_type: connection.type,
            window_location: window.location.href,
            referer: document.referrer      
        };
    
        $('#device-info input').val(JSON.stringify(deviceInfoObj));
        
    }, 100);

JS;

$this->registerJs($script);


