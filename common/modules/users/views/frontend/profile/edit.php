<?php

use yii\helpers\Html;
use \modules\users\Module;
use yii\widgets\ActiveForm;
use common\widgets\crop\Widget;

/**
 * Страница редактирования профиля, который привязан к организации
 *
 * @var $this yii\web\View
 * @var $orgModel \modules\organisations\models\frontend\Organisations
 * @var $profile \modules\users\models\frontend\Profiles
 * @var $userModel \modules\users\models\backend\Users - модель юзера этого профиля
 * @var $ownOrgProfile \modules\users\models\frontend\Profiles - собственный профиль для этой организации
 * @var $canChangeRole bool - может ли текущий пользователь менять тут роль
 * @var $exceptedRoles - массив ролей, которые нужно исключить из списка доступных к выбору ролей
 * @var $canDelete bool - отображат или нет кнопку удаления
 */

$this->title                     = 'Редактирование профиля';
$this->params['pageIcon']        = 'user';
$this->params['place']           = 'my-organisations';
$this->params['pageTitle']       = $this->title;
//$this->params['breadcrumbs'][]   = ['label' => 'мои организации', 'url' => ['/my-organisations']];
$this->params['breadcrumbs'][]   = $orgModel->brand;
$this->params['breadcrumbs'][]   = ['label' => 'команда', 'url' => ['/team/'.$orgModel->id]];
$this->params['breadcrumbs'][]   = $this->title;

?>

<h3 class="mt-0 mb-30 pb-5">Профиль</h3>
<?php $form = ActiveForm::begin([
    'action' => '/profile/save-edit/'.$profile->id,
    'method' => 'post'
]); ?>

<div class="row">
    <!-- фио -->
    <div class=" col-md-6 col-sm-12 col-lg-6">
        <div class="card">
            <div class="card-header card-header-icon" data-background-color="blue">
                <i class="fas fa-user-circle text-28"></i>
            </div>
            <div class="card-content">
                <h4 class="card-title pb-20">Контактные данные</h4>

                <!-- должность -->
                <div class="row">
                    <div class="col-xs-12 pl-20 pt-10">
                        <label class="col-xs-1 align-right pr-0 mr-0 mt-15 lead">
                            <i class="fas fa-user-tag pull-right"></i>
                        </label>
                        <div class="col-xs-10">
                            <?= $form->field($profile, 'position', [
                                'options' => [
                                    'class'    => 'form-group label-floating mt-5'
                                ],
                            ])->textInput(['class' => 'form-control']); ?>
                        </div>
                        <div class="col-xs-1 align-right pr-5 mr-0 mt-0 pl-0 ml-0 ">
                        <span class="btn btn-just-icon btn-simple ml-0 hover-rounded"
                              data-toggle="popover"
                              data-placement="bottom"
                              data-content="Указывается фактическая должность, род занятий или область ответственности, что бы можно было понять по какому вопросу можно обратиться."
                              title="Должность">
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
                            <?= $form->field($profile, 'custom_contacts', [
                                'options' => [
                                    'class'    => 'form-group label-floating mt-5'
                                ],
                            ])->textarea(['class' => 'form-control', 'rows' => 6]); ?>
                        </div>
                        <div class="col-xs-1 align-right pr-5 mr-0 mt-0 pl-0 ml-0 ">
                        <span class="btn btn-just-icon btn-simple ml-0 hover-rounded"
                              data-toggle="popover"
                              data-placement="bottom"
                              data-content="Произвольное описание контактов (skype, telegram, vk, whatsapp, jabber и т.д.), а так же сюда возможно вписать некоторые примечания.
                              Доступны теги &lt;br&gt; &lt;strong&gt; &lt;b&gt; &lt;a&gt; . Попытки использования JavaScript - поставлены на особый контроль и блокируются. Использование style атрибута так же заблокировано."
                              title="Контакты">
                            <i class="far fa-question-circle text-16 opacity-40"></i>
                        </span>

                        </div>
                    </div>
                </div>


                <!-- роль -->
                <div class="row">
                    <div class="col-xs-12 pl-20 pt-10">
                        <label class="col-xs-1 align-right pr-0 mr-0 mt-15 lead">
                            <i class="fas fa-user-tie pull-right pull-right"></i>
                        </label>
                        <div class="col-xs-10">
                            <?php
                            $params = [
                                'class' => 'selectpicker mt-0',
                                'data-style' => 'select-with-transition',
                                'title' => 'Роль:',
                                'data-size' => 7,
                                'disabled' => !$canChangeRole,
                                'options' => [
                                    '99' => ['disabled' => true],
                                ]
                            ];

                            echo $form->field($profile, 'role')
                                ->dropDownList(['99' => 'Роль:'] + $profile->rolesLabels(true, $exceptedRoles), $params)
                            ->label(null, ['class' => 'mt-0 mb-0']);

                            ?>
                        </div>
                        <div class="col-xs-1 align-right pr-5 mr-0 mt-0 pl-0 ml-0 ">
                        <span class="btn btn-just-icon btn-simple ml-0 hover-rounded"
                              data-toggle="popover"
                              data-placement="bottom"
                              data-content="Роль профиля в организации. Определяет уровень возможностей по управлению организацией и другими профилями."
                              title="Роль">
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
                            ID профиля: <?= $profile->id ?>
                        </div>
                        <div class="col-xs-1 align-right pr-5 mr-0 mt-0 pl-0 ml-0 ">
                        <span class="btn btn-just-icon btn-simple ml-0 hover-rounded pt-10 mt-0 mb-0 pb-10"
                              data-toggle="popover"
                              data-placement="bottom"
                              data-content="Идентификатор профиля в системе"
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
                            Дата создания: <?= date('d.m.Y', $profile->created_at) ?>
                        </div>
                        <div class="col-xs-1 align-right pr-5 mr-0 mt-0 pl-0 ml-0">
                        <span class="btn btn-just-icon btn-simple ml-0 hover-rounded pt-10 mt-0 mb-0 pb-10"
                              data-toggle="popover"
                              data-placement="bottom"
                              data-content="Дата создания профиля для этой организации."
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
                            Профиль для организации:<br><strong> <?= $orgModel->brand ?></strong>
                        </div>
                        <div class="col-xs-1 align-right pr-5 mr-0 mt-0 pl-0 ml-0">
                        <span class="btn btn-just-icon btn-simple ml-0 hover-rounded pt-10 mt-0 mb-0 pb-10"
                              data-toggle="popover"
                              data-placement="bottom"
                              data-content="Организация с которой связан текущий профиль."
                              title="">
                            <i class="far fa-question-circle text-16 opacity-40"></i>
                        </span>

                        </div>
                    </div>
                </div>

                <!-- роль -->
                <div class="row">
                    <div class="col-xs-12 pl-20">
                        <label class="col-xs-1 align-right pr-0 mr-0 pt-10 lead">
                            <i class="fas fa-user-tie pull-right"></i>
                        </label>
                        <div class="col-xs-10 pt-10">
                            Роль в организации: <strong> <?= $profile->rolesLabels()[$profile->role] ?></strong><br>
                            Статус роли: <?= $profile->getInviteStatusLabel() ?> <?= $profile->invite_date ? date('d.m.Y', $profile->invite_date) : ''  ?>
                        </div>
                        <div class="col-xs-1 align-right pr-5 mr-0 mt-0 pl-0 ml-0">
                        <span class="btn btn-just-icon btn-simple ml-0 hover-rounded pt-10 mt-0 mb-0 pb-10"
                              data-toggle="popover"
                              data-placement="bottom"
                              data-content="Роль определяет возможности управления командой и организацией."
                              title="Роль в организации">
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
    <button  class="btn btn-success btn-round"><i class="fas fa-save text-18 button-icon mr-5"></i>&nbsp; Сохранить</button>
</div>

<?php ActiveForm::end(); ?>

<?php if ($canDelete): ?>
<div class="text-right">
    <button  class="btn btn-danger btn-round"
             data-action="confirmation"
             data-action-title="Удалить профиль?"
             data-action-text=""
             data-action-url="/profile/delete/<?= $profile->id  ?>"
             data-action-confirm-btn="Удалить"
             data-confirm-color="#f8bb86"
    ><i class="fas fa-trash-alt text-18 button-icon mr-5"></i>&nbsp;&nbsp; Удалить</button>
</div>
<?php endif; ?>


