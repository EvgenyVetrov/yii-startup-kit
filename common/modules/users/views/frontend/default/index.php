<?php

use yii\helpers\Html;
use \modules\users\Module;
use yii\widgets\ActiveForm;
use common\widgets\crop\Widget;

/**
 * Страница профиля. Профиль
 *
 * @var $this yii\web\View
 * @var $model \modules\users\models\frontend\Users
 */

$this->title                     = 'Профиль';
$this->params['pageIcon']        = 'user';
$this->params['place']           = 'user';
$this->params['pageTitle']       = $this->title;
$this->params['breadcrumbs'][]   = $this->title;
$model->subscribe_news           = $model->subscribe_news === null ? 0 : 1;
$model->subscribe_notifications  = $model->subscribe_notifications === null ? 0 : 1;

$this->params['place'] = 'profile';

?>

<h3 class="mt-0 mb-30 pb-5">Профиль</h3>
<?php $form = ActiveForm::begin([
        'action' => 'profile',
        'options' => ['enctype' => 'multipart/form-data']
]); ?>
<input style="display:none">
<input type="password" style="display:none">
<div class="row">
    <!-- фио -->
    <div class=" col-md-6 col-sm-12 col-lg-6">
        <div class="card">
            <div class="card-header card-header-icon" data-background-color="blue">
                <i class="fas fa-user-circle text-28"></i>
            </div>
            <div class="card-content">
                <h4 class="card-title pb-20">Контактные данные</h4>

                <!-- Фамилия -->
                <div class="row">
                    <div class="col-xs-12 pl-20 pt-10">
                        <label class="col-xs-1 align-right pr-0 mr-0 mt-15 lead">
                            <i class="fa fa-address-card pull-right"></i>
                        </label>
                        <div class="col-xs-10">
                            <?= $form->field($model, 'last_name', [
                                'options' => [
                                    'class'    => 'form-group label-floating mt-5'
                                ],
                            ])->textInput(['class' => 'form-control']); ?>
                        </div>
                        <div class="col-xs-1 align-right pr-5 mr-0 mt-0 pl-0 ml-0 ">
                        <span class="btn btn-just-icon btn-simple ml-0 hover-rounded"
                              data-toggle="popover"
                              data-placement="bottom"
                              data-content="Заполните свою фамилию"
                              title="">
                            <i class="far fa-question-circle text-16 opacity-40"></i>
                        </span>

                        </div>
                    </div>
                </div>

                <!-- Имя -->
                <div class="row">
                    <div class="col-xs-12 pl-20 pt-10">
                        <label class="col-xs-1 align-right pr-0 mr-0 mt-15 lead">
                            <i class="fa fa-address-card pull-right"></i>
                        </label>
                        <div class="col-xs-10">
                            <?= $form->field($model, 'first_name', [
                                'options' => [
                                    'class'    => 'form-group label-floating mt-5'
                                ],
                            ])->textInput(['class' => 'form-control']); ?>
                        </div>
                        <div class="col-xs-1 align-right pr-5 mr-0 mt-0 pl-0 ml-0 ">
                        <span class="btn btn-just-icon btn-simple ml-0 hover-rounded"
                              data-toggle="popover"
                              data-placement="bottom"
                              data-content="Обязательно заполните свое имя"
                              title="">
                            <i class="far fa-question-circle text-16 opacity-40"></i>
                        </span>

                        </div>
                    </div>
                </div>

                <!-- Отчество -->
                <div class="row">
                    <div class="col-xs-12 pl-20 pt-10">
                        <label class="col-xs-1 align-right pr-0 mr-0 mt-15 lead">
                            <i class="fa fa-address-card pull-right"></i>
                        </label>
                        <div class="col-xs-10">
                            <?= $form->field($model, 'patronymic', [
                                'options' => [
                                    'class'    => 'form-group label-floating mt-5'
                                ],
                            ])->textInput(['class' => 'form-control']); ?>
                        </div>
                        <div class="col-xs-1 align-right pr-5 mr-0 mt-0 pl-0 ml-0 ">
                                    <span class="btn btn-just-icon btn-simple ml-0 hover-rounded"
                                          data-toggle="popover"
                                          data-placement="bottom"
                                          data-content="Отчество. Что бы к Вам можно было обратиться более официально"
                                          title="">
                                        <i class="far fa-question-circle text-16 opacity-40"></i>
                                    </span>

                        </div>
                    </div>
                </div>

                <!-- Телефон -->
                <div class="row">
                    <div class="col-xs-12 pl-20 pt-10">
                        <label class="col-xs-1 align-right pr-0 mr-0 mt-15">
                            <i class="material-icons">phone</i>
                        </label>
                        <div class="col-xs-10">
                            <?= $form->field($model, 'phone', [
                                'options' => [
                                    'class'    => 'form-group label-floating mt-5'
                                ],
                            ])->textInput(['class' => 'form-control']); ?>
                        </div>
                        <div class="col-xs-1 align-right pr-5 mr-0 mt-0 pl-0 ml-0 ">
                            <span class="btn btn-just-icon btn-simple ml-0 hover-rounded"
                                  data-toggle="popover"
                                  data-placement="bottom"
                                  data-content="Телефон по которому с Вами можно связаться.  При оставлении откликов или закупок возможно использовать другой телефон или способ связи."
                                  title="Телефон">
                                <i class="far fa-question-circle text-16 opacity-40"></i>
                            </span>

                        </div>
                    </div>
                </div>

                <!-- контакты -->
                <div class="row">
                    <div class="col-xs-12 pl-20 pt-10">
                        <label class="col-xs-1 align-right pr-0 mr-0 mt-15 lead">
                            <i class="fas fa-address-book pull-right"></i>
                        </label>
                        <div class="col-xs-10">
                            <?= $form->field($model, 'contacts', [
                                'options' => [
                                    'class'    => 'form-group label-floating mt-5'
                                ],
                            ])->textarea(['class' => 'form-control', 'rows' => 6]); ?>
                        </div>
                        <div class="col-xs-1 align-right pr-5 mr-0 mt-0 pl-0 ml-0 ">
                        <span class="btn btn-just-icon btn-simple ml-0 hover-rounded"
                              data-toggle="popover"
                              data-placement="bottom"
                              data-content="Произвольное описание других контактов (skype, telegram, vk, whatsapp, jabber и т.д.), а так же сюда возможно вписать некоторые примечания.
                              Доступны теги &lt;br&gt; &lt;strong&gt; &lt;b&gt; &lt;a&gt; . Попытки использования JavaScript - поставлены на особый контроль и блокируются. Использование style атрибута так же заблокировано."
                              title="Контакты">
                            <i class="far fa-question-circle text-16 opacity-40"></i>
                        </span>

                        </div>
                    </div>
                </div>


                <!-- аватар -->
                <div class="row">
                    <div class="col-xs-12 pl-20 pt-10">
                        <label class="col-xs-1 align-right pr-0 mr-0 mt-15 ">
                            <i class="fas fa-camera text-20"></i>
                        </label>
                        <div class="col-xs-10 pb-20">
                            <p class="text-muted pt-10">Фото профиля:</p>

                            <div id="avatar-image-container">
                                <?= $this->render('_profile-avatar-container', ['model' => $model]); ?>
                            </div>


                            <!-- Кнопка пуска модальное окно -->
                            <button type="button"  id="avatar-modal-btn" class="btn btn-info btn-round" data-toggle="modal" data-target="#avatar-modal">
                                <i class="fas fa-download button-icon text-16"></i>&nbsp; Загрузить фото
                            </button>


                        </div>
                        <div class="col-xs-1 align-right pr-5 mr-0 mt-0 pl-0 ml-0 ">
                        <span class="btn btn-just-icon btn-simple ml-0 hover-rounded"
                              data-toggle="popover"
                              data-placement="bottom"
                              data-content="Загрузите Вашу фотографию. Комфортнее общаться с человеком, которого знаешь в лицо. Загрузите изображение 500х500px или более (до 1 Mb)."
                              title="Аватар">
                            <i class="far fa-question-circle text-16 opacity-40"></i>
                        </span>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- авторизация -->
    <div class=" col-md-6 col-sm-12 col-lg-6">
        <div class="card">
            <div class="card-header card-header-icon" data-background-color="rose">
                <i class="fas fa-user-lock text-28"></i>
            </div>
            <div class="card-content">
                <h4 class="card-title pb-20">Данные для входа</h4>

                <!-- Меил -->
                <div class="row">
                    <div class="col-xs-12 pl-20 pt-10">
                        <label class="col-xs-1 align-right pr-0 mr-0 mt-15">
                            <i class="material-icons">email</i>
                        </label>
                        <div class="col-xs-10">
                            <?= $form->field($model, 'email', [
                                'options' => [
                                    'class'    => 'form-group label-floating mt-5'
                                ],
                            ])->textInput(['class' => 'form-control', 'autocomplete' => "off"]); ?>
                        </div>
                        <div class="col-xs-1 align-right pr-5 mr-0 mt-0 pl-0 ml-0 ">
                                <span class="btn btn-just-icon btn-simple ml-0 hover-rounded"
                                      data-toggle="popover"
                                      data-placement="bottom"
                                      data-content="Электронная почта для входа в систему (логин)"
                                      title="Email">
                                    <i class="far fa-question-circle text-16 opacity-40"></i>
                                </span>

                        </div>
                    </div>
                </div>

                <!-- старый пароль -->
                <div class="row">
                    <div class="col-xs-12 pl-20 pt-10">
                        <label class="col-xs-1 align-right pr-0 mr-0 mt-15 lead">
                            <i class="fa fa-key pull-right"></i>
                        </label>
                        <div class="col-xs-10">
                            <?= $form->field($model, 'password_old', [
                                'options' => [
                                    'class'    => 'form-group label-floating mt-5'
                                ],
                            ])->textInput(['class' => 'form-control', 'autocomplete' => "off"]); ?>
                        </div>
                        <div class="col-xs-1 align-right pr-5 mr-0 mt-0 pl-0 ml-0 ">
                            <span class="btn btn-just-icon btn-simple ml-0 hover-rounded"
                                  data-toggle="popover"
                                  data-placement="bottom"
                                  data-content="Введите текущий пароль с которым вы вошли в систему."
                                  title="Старый пароль">
                                <i class="far fa-question-circle text-16 opacity-40"></i>
                            </span>

                        </div>
                    </div>
                </div>

                <!-- новый пароль -->
                <div class="row">
                    <div class="col-xs-12 pl-20 pt-10">
                        <label class="col-xs-1 align-right pr-0 mr-0 mt-15 lead">
                            <i class="fa fa-unlock-alt pull-right"></i>
                        </label>
                        <div class="col-xs-10">
                            <?= $form->field($model, 'password_new', [
                                'options' => [
                                    'class'    => 'form-group label-floating mt-5'
                                ],
                            ])->textInput(['class' => 'form-control', 'autocomplete' => "off"]); ?>
                        </div>
                        <div class="col-xs-1 align-right pr-5 mr-0 mt-0 pl-0 ml-0 ">
                                    <span class="btn btn-just-icon btn-simple ml-0 hover-rounded"
                                          data-toggle="popover"
                                          data-placement="bottom"
                                          data-content="Придумайте и запишите новый пароль. Не менее 7 символов. Рекомендуем использовать строчные и заглавные буквы, цифры. Не вводите пароль, который используется на других сайтах."
                                          title="Новый пароль">
                                        <i class="far fa-question-circle text-16 opacity-40"></i>
                                    </span>

                        </div>
                    </div>
                </div>

                <!-- повторить пароль -->
                <div class="row">
                    <div class="col-xs-12 pl-20 pt-10">
                        <label class="col-xs-1 align-right pr-0 mr-0 mt-15 lead">
                            <i class="fa fa-lock pull-right"></i>
                        </label>
                        <div class="col-xs-10">
                            <?= $form->field($model, 'password_repeat', [
                                'options' => [
                                    'class'    => 'form-group label-floating mt-5'
                                ],
                            ])->textInput(['class' => 'form-control', 'autocomplete' => "off"]); ?>
                        </div>
                        <div class="col-xs-1 align-right pr-5 mr-0 mt-0 pl-0 ml-0 ">
                            <span class="btn btn-just-icon btn-simple ml-0 hover-rounded"
                                  data-toggle="popover"
                                  data-placement="bottom"
                                  data-content="Введите новый пароль повторно, что бы убедиться в его правильности написания"
                                  title="">
                                <i class="far fa-question-circle text-16 opacity-40"></i>
                            </span>

                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>

    <!-- метаданные -->
    <div class=" col-md-6 col-sm-12 col-lg-6">
        <div class="card">
            <div class="card-header card-header-icon" data-background-color="default">
                <i class="fas fa-info-circle text-28"></i>
            </div>
            <div class="card-content">
                <h4 class="card-title pb-20">Информация</h4>

                <!-- ID -->
                <div class="row">
                    <div class="col-xs-12 pl-20 pt-10">
                        <label class="col-xs-1 align-right pr-0 mr-0 pt-10 lead">
                            <i class="fa fa-id-card pull-right"></i>
                        </label>
                        <div class="col-xs-10 pt-10">
                            ID: <?= $model->id ?>
                        </div>
                        <div class="col-xs-1 align-right pr-5 mr-0 mt-0 pl-0 ml-0 ">
                        <span class="btn btn-just-icon btn-simple ml-0 hover-rounded pt-10 mt-0 mb-0 pb-10"
                              data-toggle="popover"
                              data-placement="bottom"
                              data-content="Идентификатор пользователя в системе"
                              title="">
                            <i class="far fa-question-circle text-16 opacity-40"></i>
                        </span>

                        </div>
                    </div>
                </div>

                <!-- Дата создания -->
                <div class="row">
                    <div class="col-xs-12 pl-20">
                        <label class="col-xs-1 align-right pr-0 mr-0 pt-10 lead">
                            <i class="fa fa-birthday-cake pull-right"></i>
                        </label>
                        <div class="col-xs-10 pt-10">
                            Дата регистрации: <?= date('d.m.Y', $model->time_registration) ?>
                        </div>
                        <div class="col-xs-1 align-right pr-5 mr-0 mt-0 pl-0 ml-0">
                        <span class="btn btn-just-icon btn-simple ml-0 hover-rounded pt-10 mt-0 mb-0 pb-10"
                              data-toggle="popover"
                              data-placement="bottom"
                              data-content="Дата начала пользования системой"
                              title="">
                            <i class="far fa-question-circle text-16 opacity-40"></i>
                        </span>

                        </div>
                    </div>
                </div>

                <!-- Текущая организация -->
                <div class="row">
                    <div class="col-xs-12 pl-20">
                        <label class="col-xs-1 align-right pr-0 mr-0 pt-10 lead">
                            <i class="fa fa-building pull-right"></i>
                        </label>
                        <div class="col-xs-10 pt-10">
                            Текущая организация:<br><strong> <?= $model->current_organisation_brand ?></strong>
                        </div>
                        <div class="col-xs-1 align-right pr-5 mr-0 mt-0 pl-0 ml-0">
                        <span class="btn btn-just-icon btn-simple ml-0 hover-rounded pt-10 mt-0 mb-0 pb-10"
                              data-toggle="popover"
                              data-placement="bottom"
                              data-content="Организация с которой в настоящий момент вы работаете."
                              title="Текущая организация">
                            <i class="far fa-question-circle text-16 opacity-40"></i>
                        </span>

                        </div>
                    </div>
                </div>

                <!-- email -->
                <div class="row">
                    <div class="col-xs-12 pl-20">
                        <label class="col-xs-1 align-right pr-0 mr-0 pt-10 lead">
                            <i class="fa fa-building pull-right"></i>
                        </label>
                        <div class="col-xs-10 pt-10">
                            Email: <?= $model->email ?> <?= $model->activate_time ? '<span class="text-success">(подтвержден)</span>' : '<span class="text-danger">(не подтвержден)</span>'  ?>

                            <?php if (!$model->activate_time): ?>
                                <button class="btn btn-primary btn-sm"
                                        data-action="confirmation"
                                        data-confirm-color="#f8bb86"
                                        data-action-url="/user/resend-activation"
                                        data-action-text="Письмо подтверждения Вашего Email будет выслано повторно на указанную почту."
                                        data-action-title="Отправить письмо?"
                                        data-action-confirm-btn = "Отправить"

                                >
                                    Запросить активацию </button>
                            <?php endif; ?>
                        </div>
                        <div class="col-xs-1 align-right pr-5 mr-0 mt-0 pl-0 ml-0">
                        <span class="btn btn-just-icon btn-simple ml-0 hover-rounded pt-10 mt-0 mb-0 pb-10"
                              data-toggle="popover"
                              data-placement="bottom"
                              data-content="Основной email (логин). Для подтверждения почты пройдите по ссылке активации, отправленной Вам на эту почту. Без подтверждения почты многие важные функции системы недоступны."
                              title="Email">
                            <i class="far fa-question-circle text-16 opacity-40"></i>
                        </span>

                        </div>
                    </div>
                </div>



            </div>
        </div>
    </div>

</div>

<div class="text-center">
    <button  class="btn btn-success btn-round"><i class="material-icons">save</i>&nbsp; Сохранить</button>
</div>

<?php ActiveForm::end(); ?>

<?= $this->render('_profile-modals') ?>

