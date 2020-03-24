<?php

use common\components\ActiveForm;

/**
 * Страница создания профиля
 *
 * @var $this \yii\web\View
 * @var $model \modules\users\models\frontend\Profiles
 * @var $orgModel \modules\organisations\models\frontend\Organisations
 * @var $userModel \modules\users\models\frontend\Users
 * @var $exceptedRoles array - список ролей, которые нужно исключить из списка доступных
 */


$this->title                     = 'Создание профиля';
$this->params['pageIcon']        = 'user';
$this->params['place']           = 'my-organisations';
$this->params['pageTitle']       = $this->title;
$this->params['breadcrumbs'][]   = ['label' => 'мои организации', 'url' => ['/my-organisations']];
$this->params['breadcrumbs'][]   = $orgModel->brand;
$this->params['breadcrumbs'][]   = ['label' => 'команда', 'url' => ['/team/']];
$this->params['breadcrumbs'][]   = $this->title;

?>

<h3>Добавление пользователя в команду:</h3>
<p>
    Организация: <?= $orgModel->brand ?> <br>
    Пользователь: <?= $userModel->first_name. ' ' .$userModel->last_name ?> (#<?= $userModel->id ?>)
</p>

<div class="row">
    <div class="col-md-6">
        <div class="card ">
            <div class="card-header ">
                <h4 class="card-title">Создание профиля
                </h4>
            </div>
            <div class="card-body ">
                <?php $form = ActiveForm::begin([
                    'id'     => 'registration-form',
                    'action' => '/profile/save',
                    'method' => 'post'
                ]); ?>

                <?= $form->field($model, 'position', [
                    'options' => [
                        'class'    => 'form-group label-floating mt-10'
                    ],
                ])->textInput(['class' => 'form-control']) ?>


                <?php
                $params = [
                    'class' => 'selectpicker',
                    'data-style' => 'select-with-transition',
                    'title' => 'Роль:',
                    'data-size' => 7,
                    'options' => [
                        '99' => ['disabled' => true]
                    ]
                ];

                echo $form->field($model, 'role')
                    ->dropDownList(['99' => 'Роль:'] + $model->rolesLabels(true, $exceptedRoles), $params)
                    ->label(false);

                ?>

                <?= $form->field($model, 'user_id')->hiddenInput()->label(false) ?>
                <?= $form->field($model, 'org_id')->hiddenInput()->label(false) ?>

                <button class="btn btn-success btn-round pull-right mb-20">
                    <i class="fas fa-user-plus button-icon text-16 mr-5"></i> Создать
                </button>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <h4> <i class="fas fa-question-circle mr-10"></i> Справка по профилям:</h4>
        <p><strong>Профиль</strong> - это совокупность специфичных данных пользователя, привязанных к конкретной организации.
            То есть в рамках организации человек может иметь свою должность, рабочие контакты, роль.</p>
        <p>В 1 организации у 1 человека может быть только 1 профиль. При этом у человека могут быть другие профили для других
            организаций, а к 1 организации моут быть прикреплены несколько профилей разных людей.</p>
        <p>
            Профиль определяет <strong>уровень доступа к организации</strong>:
        </p>
        <ul>
            <li>
                Владелец - имеет все права для управления организацией. Владельцев может быть несколько.
                Владелец может создавать и изменять любые профили в организации, в т.ч. других владельцев.
                Так же владелец может быть назначен или изменен модераторами сервиса в случае спорных вопросов
                и предоставления доказательств легитимности владения. <br>
                <strong>Первый профиль </strong> создается владельцем/управляющим организации самому себе.
            </li>
            <li>
                Управляющий - имеет те же возможности, что и владелец, но не может изменять профили владельцев.
                Руководители/директора филиалов по сути являются управляющими и при модерировании таких профилей
                будет устанавливаться именно эта роль.
            </li>
            <li>
                Редактор - имеет возможность изменять данные организации, составлять закупки и делать отклики на чужие закупки.
                Приглашать кого-либо в команду (создавать профили) - не может.
            </li>
            <li>
                Оператор - имеет возможность только составлять закупки и делать отклики на чужие закупки.
                Приглашать кого-либо в команду (создавать профили) - не может.
            </li>
        </ul>

        <p><strong>После создания профиля</strong> в разделе организации у человека появляется новая организация
            с призывом подтвердить участие и дозаполнить профиль. После подтверждения и заполнения - во всех
            закупках и откликах от имени организации для этого человека будут указываться контакты и информация
            именно из этого профиля.
        </p>
    </div>
</div>
