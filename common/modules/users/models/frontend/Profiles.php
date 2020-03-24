<?php
/**
 * Модель профилей для фронта
 */

namespace modules\users\models\frontend;

use modules\organisations\models\frontend\Organisations;
use Yii;
use modules\users\models\BaseProfiles;
use modules\organisations\models\BaseOrganisations;
use yii\web\ForbiddenHttpException;

class Profiles extends BaseProfiles
{
    /**
     * Может ли текущий пользователь редактировать профиль
     * @return bool
     * @param $ownProfileModel Profiles
     */
    public function canEditProfile($ownProfileModel = null)
    {
        if (Yii::$app->user->id == $this->user_id) {
            return true;
        }

        // todo: сюда еще можно было бы добавить условие статуса профиля... но пока нет кейса смены статуса в профилях
        if ($ownProfileModel AND $ownProfileModel->invite_status == self::INVITE_CONFIRMED) {

            if ($ownProfileModel->role == self::ROLE_OWNER) { // владелец может делать всё
                return true;
            }

            // менеджер может тоже всех редактировать, кроме владельцев
            if ($ownProfileModel->role == self::ROLE_MANAGER AND $this->role != self::ROLE_OWNER) {
                return true;
            }
        }
        return false;
    }



    /**
     * Может ли текущий пользователь добавлять профили к организации
     * тут нет проверки на создание конкретного профиля, просто профили в целом
     *
     * @param Organisations $orgModel
     * @return bool
     */
    public static function canCreateProfile(Organisations $orgModel) {

        $orgRelationProfile = self::find()
            ->where(['org_id' => $orgModel->id, 'user_id' => Yii::$app->user->id])
            ->asArray()
            ->limit(1)
            ->one();

        if ($orgRelationProfile AND count($orgRelationProfile) AND $orgRelationProfile['role'] == self::ROLE_OWNER OR $orgRelationProfile['role'] == self::ROLE_MANAGER) {
            return true;
        }

        $haveManagers = self::find()
            ->where(['org_id' => $orgModel->id, 'role' => [self::ROLE_OWNER, self::ROLE_MANAGER]])
            ->exists();

        // если нет ни одного менеджера или владельца, то если юзер автор организации - то он может добавлять профайлы
        if (!$haveManagers AND $orgModel->author_id == Yii::$app->user->id) {
            return true;
        }


        return false;
    }



    /**
     * Можно ли конкретного юзеру создать профиль для текущей организации
     *
     *
     * @param Users $userModel
     * @param Organisations $orgModel
     * @return array
     */
    public static function canAddUser(Users $userModel, Organisations $orgModel)
    {
        $canCreate = self::canCreateProfile($orgModel);
        if (!$canCreate) {
            return [
                'status' => 'error',
                'text'   => 'Вы не можете создавать профили для организации: '. $orgModel->brand
            ];
        }

        $existProfile = self::find()
            ->where(['org_id' => $orgModel->id, 'user_id' => $userModel->id])
            ->exists();

        if ($existProfile) {
            return [
                'status' => 'error',
                'text'   => 'Данный пользователь уже присутствует в команде организации.'
            ];
        }

        return [
            'status' => 'success',
            'text'   => ''
        ];

    }



    /**
     * Может ли текущий пользователь менять роль this профиля
     *
     * @param $ownProfileModel Profiles
     * @param $role_id - новая роль, которая приходит из POST запроса при сохранения
     * @return bool
     * @throws ForbiddenHttpException
     */
    public function canChangeRole($ownProfileModel, $role_id)
    {
        if (!$ownProfileModel) {
            throw new ForbiddenHttpException('Для смены роли как минимум Вы должны иметь свой собственный профиль в данной организации. На текущий момент профиль не найден.');
        }

        if (!$role_id) { return false; }

        // редакторы, операторы и неизвестные не могут редактировать ни чи роли, даже свои
        if (in_array($ownProfileModel->role, [self::ROLE_UNDEFINED, self::ROLE_REDACTOR, self::ROLE_OPERATOR])) {
            return false;
        }

        // владелец может править любые роли
        if ($ownProfileModel->role == self::ROLE_OWNER) {
            return true;
        }

        // менеджер может править все роли, кроме владельца
        if ($ownProfileModel->role == self::ROLE_MANAGER AND $role_id != self::ROLE_OWNER) {
            return true;
        }

        return false;
    }



    /**
     * @param $ownProfileModel Profiles
     * @return bool
     */
    public function canDelete($ownProfileModel)
    {
        if (!$ownProfileModel) { return false; } // если свой профиль еще не сформирован для организации, то удалять чужие нельзя

        if ($ownProfileModel->id == $this->id) { return true; } // свой собственный профиль можно удалить
        if ($ownProfileModel->role == self::ROLE_OWNER) { return true; }        // владелец может всё
        if ($ownProfileModel->role == self::ROLE_MANAGER AND $this->role != self::ROLE_OWNER) { return true; } // менеджер удаляет всех кроме владельца

        return false;
    }



    /**
     * Управлять приглашением в организацию может только самолично текущий юзер
     * @return bool
     */
    public function canManageInvite()
    {
        if ($this->user_id == Yii::$app->user->id) {
            return true;
        }

        return false;
    }

}





































