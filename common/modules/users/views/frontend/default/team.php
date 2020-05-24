<?php

use common\components\ActiveForm;

/**
 * Страница списка команды организации
 *
 * @var $this yii\web\View
 * @var $orgModel \modules\organisations\models\frontend\Organisations
 * @var $profileModel \modules\users\models\frontend\Profiles
 * @var $ownProfileModel \modules\users\models\frontend\Profiles
 * @var $profiles \modules\users\models\frontend\Profiles[]
 * @var $canCreateProfile bool
 */

$this->title                     = 'Команда';
$this->params['pageIcon']        = 'fas user';
$this->params['place']           = 'my-organisations';
$this->params['pageTitle']       = $this->title;
$this->params['breadcrumbs'][]   = ['label' => 'мои организации', 'url' => ['/my-organisations']];
$this->params['breadcrumbs'][]   = $orgModel->brand;
$this->params['breadcrumbs'][]   = $this->title;


//d($orgModel->ownOrgProfile);
?>

<?php if ($canCreateProfile): ?>
<div class="row">
    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
        <?php $form = ActiveForm::begin([
            'id'     => 'registration-form',
            'action' => '/profile/create/'.$orgModel->id,
            'method' => 'post'
        ]); ?>
        <div class="card ">
            <div class="card-body pr-15 pl-20 pb-10 pt-10">

                <div class="row">
                    <div class="col-xs-5">
                        <?= $form->field($profileModel, 'user_id', [
                            'options' => [
                                'class'    => 'form-group label-floating mt-10'
                            ],
                        ])
                            ->textInput(['class' => 'form-control', 'placeholder' => 'ID пользователя'])
                            ->label(false); ?>
                    </div>
                    <div class="col-xs-7">
                        <button class="btn btn-success btn-round pull-right">
                            <i class="fas fa-user-plus button-icon text-16 mr-5"></i> Добавить
                            <div class="ripple-container"></div>
                        </button>
                    </div>
                </div>

            </div>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
<?php endif; ?>

<div class="row">
    <?php foreach ($profiles as $profile): ?>
        <div class="col-lg-4 col-md-6 col-sm-6 <?= ($profile->invite_status == 2) ? 'opacity-40' : '' ?>">
            <div class="card card-stats pl-sm-20 pr-sm-20 pl-md-0 pr-md-0">
                <?php if ($profile->user->avatar): ?>

                    <div class="card-header" data-background-color=""
                         style="background-image: url(<?= $profile->user->getAvatarPath('web') . '/thumb-'. $profile->user->avatar ?>);">
                        <div class="svg-container-56 svg-fff">

                        </div>
                    </div>

                <?php else: ?>

                <div class="card-header" data-background-color="" style="background-color: #<?= $orgModel->logo_background ? $orgModel->logo_background : 999  ?>;">
                    <div class="svg-container-56 svg-fff">
                        <i class="fas fa-user-circle "></i>
                    </div>
                </div>

                <?php endif; ?>
                <div class="card-content pb-0">
                    <p>
                        <small class="category"><?= $profile->position ?><br></small>
                        <span class="lead"><?= $profile->user->first_name . ' '. $profile->user->last_name ?></span>
                    </p>
                </div>
                <div class="clearfix"></div>

                <div class="card-content">
                    <div class="clearer"></div>
                    <p>
                        <span>ID профиля: <?= $profile->id ?></span>
                        <span class="pull-right">Роль: <?= $profile->rolesLabels()[$profile->role]; ?> </span>
                        <br>
                        Участие в команде:
                        <span class="<?= ($profile->invite_status == 2) ? '' : (($profile->invite_status == 1) ? 'text-success' : 'font-weight-bold text-danger') ?>">
                        <?= $profile->getInviteStatusLabel(); ?>
                        </span>
                    </p>

                    <?php if ($profile->canEditProfile($ownProfileModel)): ?>
                    <div class="text-right">

                        <a href="/profile/edit/<?= $profile->id ?>" type="button" class="btn btn-sm ink-reaction btn-raised btn-warning btn-round mb-5">
                            <i class="fas fa-edit"></i>&nbsp; управление
                        </a>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

