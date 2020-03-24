<?php
/**
 * Created by PhpStorm.
 * User: vetrov
 * Date: 08.02.2019
 * Time: 9:26
 */

namespace modules\users\controllers\frontend;

use yii;
use yii\web\Response;
use yii\web\Controller;
use modules\users\models\frontend\Users;
use modules\users\models\frontend\Profiles;
use modules\organisations\models\frontend\Organisations;


/**
 * Class ProfileController
 *
 * @package modules\users\controllers\frontend
 */
class ProfileController extends Controller
{

    /**
     * Экшн страницы создания профиля.
     *
     * @param $organisation_id
     * @return string
     * @throws yii\web\NotFoundHttpException
     */
    public function actionCreate($organisation_id)
    {
        $user_id = (int) Yii::$app->request->post()['Profiles']['user_id'];

        $userModel = Users::findModel($user_id);
        $orgModel  = Organisations::findModel($organisation_id);
        $ownOrgProfile = $orgModel->ownOrgProfile;
        $exceptedRoles = [];
        if ($ownOrgProfile) {
            $exceptedRoles = ($ownOrgProfile->role == Profiles::ROLE_MANAGER) ? [Profiles::ROLE_OWNER] : [];
        }

        $canAddUserInfo = Profiles::canAddUser($userModel, $orgModel);
        if ($canAddUserInfo['status'] == 'error') {
            Yii::$app->session->setFlash('error', $canAddUserInfo['text']);
            return $this->redirect('/team/'.$orgModel->id);
        }

        $model = new Profiles([
            'orgModel' => $orgModel,
            'user_id'  => $user_id,
            'org_id'   => $organisation_id,
        ]);

        return $this->render('create', [
            'userModel'  => $userModel,
            'orgModel'    => $orgModel,
            'model'        => $model,
            'exceptedRoles' => $exceptedRoles
        ]);
    }



    /**
     * Страница редактирования профиля
     *
     * @param $profile_id
     * @return string
     * @throws yii\web\ForbiddenHttpException
     * @throws yii\web\NotFoundHttpException
     */
    public function actionEdit($profile_id)
    {
        $profile       = Profiles::findModel($profile_id);
        $orgModel      = Organisations::findModel($profile->org_id);
        $profile->orgModel = $orgModel;
        $ownOrgProfile = $orgModel->ownOrgProfile;

        if (!$profile->canEditProfile($ownOrgProfile)) {
            throw new yii\web\ForbiddenHttpException('Вы не можете редактировать профиль #'.$profile->id);
        }

        $userModel = Users::findModel($profile->user_id);
        $exceptedRoles = ($ownOrgProfile->role == Profiles::ROLE_MANAGER) ? [Profiles::ROLE_OWNER] : [];

        return $this->render('edit' ,[
            'profile'       => $profile,
            'orgModel'      => $orgModel,
            'ownOrgProfile' => $ownOrgProfile,
            'userModel'     => $userModel,
            'canChangeRole' => $profile->canChangeRole($ownOrgProfile, $profile->role),
            'exceptedRoles' => $exceptedRoles,
            'canDelete'     => $profile->canDelete($ownOrgProfile)
        ]);
    }



    /**
     * Сохранение профиля (создание)
     * изменение лучше отдельно делать ибо другие проверки нужны
     *
     * @param bool $profile_id
     * @return array
     * @throws yii\web\NotFoundHttpException
     */
    public function actionSave()
    {
        //Yii::$app->response->format = Response::FORMAT_JSON; /* клиент принимает ответ в json */
        $model = new Profiles(['scenario' => Profiles::SCENARIO_CREATE]);
        $model->load(Yii::$app->request->post());
        $orgModel  = Organisations::findModel($model->org_id);
        $userModel = Users::findModel($model->user_id); // юзер профиля с которым работаем

        $canAddUserInfo = Profiles::canAddUser($userModel, $orgModel);
        if ($canAddUserInfo['status'] == 'error') {
            Yii::$app->session->setFlash('error', $canAddUserInfo['text']);
            $this->redirect('/team/' . $orgModel->id);
        }

        $model->invite_user = Yii::$app->user->id;
        if ($model->save()) {
            Yii::$app->session->setFlash('success', 'Профиль успешно сохранен');
            $this->redirect('/team/'.$orgModel->id);
        } else {
            return [
                'status' => 'error',
                'title'  => 'Ошибка при сохранении',
                'errors_list'   => $model->getErrors()
            ];
        }
    }



    /**
     * Сохранение изменений профиля при редактировании
     * тут может быть как сохранение своего собственного профиля, так и сохранение чужого профиля (при такой возможности)
     *
     * @param $profile_id
     * @throws yii\web\NotFoundHttpException
     */
    public function actionSaveEdit($profile_id)
    {
        $profile   = Profiles::findModel($profile_id);
        $orgModel  = Organisations::findModel($profile->org_id);
        $ownOrgProfile = $orgModel->ownOrgProfile; // профиль текущего юзера в этой организации
        $newRoleId = isset(Yii::$app->request->post()['Profiles']['role']) ? Yii::$app->request->post()['Profiles']['role'] : false;

        if (!$profile->canEditProfile($ownOrgProfile)) {
            Yii::$app->session->setFlash('error', 'Вы не можете редактировать профиль #' . $profile->id);
            return $this->redirect('/team/'.$orgModel->id);
        }


        // редактировать можно теперь, но надо проверить возможность менять статус текущим пользователем на другой статус
        if ($newRoleId !== false AND $profile->canChangeRole($ownOrgProfile, $newRoleId)) {
            $profile->setScenario(Profiles::SCENARIO_EDIT_ROLE);
        } else {
            $profile->setScenario(Profiles::SCENARIO_EDIT);
        }
        $profile->load(Yii::$app->request->post());

        if ($profile->save()) {
            Yii::$app->session->setFlash('success', 'Профиль успешно сохранен');
            return $this->redirect('/team/'.$orgModel->id);
        } else {
            Yii::$app->session->setFlash('error', 'Ошибка сохранения профиля');
            return $this->redirect('/team/'.$orgModel->id);
        }
    }



    /**
     * Удаление профиля.
     *
     * @param $id
     * @return array
     * @throws \Throwable
     * @throws yii\db\StaleObjectException
     * @throws yii\web\NotFoundHttpException
     */
    public function actionDelete($id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON; /* клиент принимает ответ в json */
        $profile   = Profiles::findModel($id);
        $orgModel  = Organisations::findModel($profile->org_id);
        $ownOrgProfile = $orgModel->ownOrgProfile; // профиль текущего юзера в этой организации


        if ($profile->canDelete($ownOrgProfile)) {
            $userProfile = Users::findModel($profile->user_id);

            // если у юзера удаляемого профиля текущая организация из профиля, то сбрасываем текущую организацию
            if ($userProfile->current_organisation == $orgModel->id) {
                $userProfile->current_organisation = 0;
                $userProfile->save();
            }
            // удаляем
            $profile->delete();

            Yii::$app->session->setFlash('success', 'Профиль успешно удален');
            $this->redirect('/team/'.$orgModel->id);
        } else {
            return [
                'status' => 'error',
                'text'   => 'Вы не можете удалить данный профиль'
            ];
        }

    }



    public function actionManageInvite($mode, $profile_id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON; /* клиент принимает ответ в json */
        $profile   = Profiles::findModel($profile_id);
        $orgModel  = Organisations::findModel($profile->org_id);

        if (!$profile->canManageInvite()) {
            return [
                'status' => 'error',
                'text'   => 'Вы не можете подтверждать или отклонять участие в этой организации.'
            ];
        }


        $profile->invite_status = ($mode == 1) ? Profiles::INVITE_CONFIRMED : Profiles::INVITE_REJECTED;
        $profile->invite_date = time();
        $profile->save();


        if ($mode == 1) {
            Yii::$app->session->setFlash('success', 'Участие в организации успешно подтверждено. Теперь вы можете обновить личную информацию, которая связана именно с этой организацией - профиль.');
            return $this->redirect('/profile/edit/'.$profile->id);
        } else {
            Yii::$app->session->setFlash('warning', 'Участие в организации успешно отклонено.');
            return $this->redirect('/my-organisations');
        }

    }

}