<?php

namespace modules\users\controllers\frontend;

use modules\organisations\models\frontend\Organisations;
use modules\users\models\BaseSession;
use modules\users\models\frontend\Profiles;
use yii;
use yii\web\Cookie;
use yii\web\Controller;
use modules\users\Module;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use yii\web\ForbiddenHttpException;
use modules\users\models\frontend\Log;
use modules\users\models\frontend\Users;
use modules\users\models\frontend\forms\Login;
use modules\users\models\frontend\forms\PasswordRecovery;

/**
 * Class DefaultController
 * @package modules\users\controllers\frontend
 */
class DefaultController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout'         => ['POST'],
                    'devices-clear'  => ['POST'],
                    'devices-delete' => ['POST'],
                ],
            ],
        ];
    }



    /**
     * @inheritdoc
     */
    public function beforeAction($action)
    {
        if ($action->id == 'registration') {
            $this->enableCsrfValidation = false;
        }

        return parent::beforeAction($action);
    }



    /**
     * Просмотр собственных настроек юзера
     * @return string|yii\web\Response
     */
    public function actionProfile()
    {
        $this->layout = 'main';
        /* @var $model Users */
        $model            = Yii::$app->user->identity;
        $model->scenario  = Users::SCENARIO_PROFILE;

        if ($model->current_organisation) {
            $organisationName = Organisations::find()->select(['brand'])->where(['id' => $model->current_organisation])->column();
            $model->current_organisation_brand = $organisationName[0];
        } else {
            $model->current_organisation_brand = 'текущая организация не выбрана';
        }


        if ($model->load(Yii::$app->request->post()) && $model->save()){
            if ($model->change_email){
                Yii::$app->session->setFlash('warning', Yii::t('app', 'MESSAGE_GUIDE_ACTIVATE_EMAIL_{email}', [
                    'email' => $model->email
                ]));
            }else{
                Yii::$app->session->setFlash('success', Yii::t('app', 'SUCCESS_SAVE_DATA'));
            }


            return $this->render('index', [
                'model' => $model
            ]);
            //return $this->redirect('/profile');
        }


        return $this->render('index', [
            'model' => $model
        ]);
    }



    /**
     * @return string
     */
    public function actionDevices()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => BaseSession::find()->where(['user_id' => Yii::$app->user->id]),
            'sort' => [
                'defaultOrder' => ['last_action' => SORT_DESC]
            ]
        ]);

        return $this->render('devices', [
            'dataProvider' => $dataProvider
        ]);
    }



    /**
     * @return yii\web\Response
     */
    public function actionDevicesClear()
    {
        Yii::$app->user->identity->resetAuth(null, true);

        Yii::$app->session->setFlash('success', Module::t('main', 'MESSAGE_DEVICES_CLEAR_SUCCESS'));

        return $this->redirect(['devices']);
    }



    /**
     * @param $id
     * @return yii\web\Response
     */
    public function actionDevicesDelete($id)
    {
        Yii::$app->user->identity->resetAuth($id, true);

        Yii::$app->session->setFlash('success', Module::t('main', 'MESSAGE_DEVICES_DELETE_SUCCESS'));

        return $this->redirect(['devices']);
    }



    /**
     * Авторизация.
     * @return string
     */
    public function actionLogin()
    {
        $model = new Login();
        $this->layout = 'empty';
        Yii::$app->session->setTimeout(3600 * 12); // пробуем избавиться от 400

        if ($model->load(Yii::$app->request->post()) && $model->login()){
            return $this->redirect(['/']);
        }

        return $this->render('login', ['model' => $model]);
    }



    /**
     * Разлогиние. Экшн работает по запросу через POST
     * @return yii\web\Response
     */
    public function actionLogout()
    {
        $user_id = Yii::$app->user->id;

        /**
         * Немного говнокода))
         */
        if (isset($_COOKIE['auth_key'])){
            $model = Users::findIdentityByAccessToken($_COOKIE['auth_key']);

            if ($model){
                Yii::$app->response->cookies->remove(new Cookie([
                    'name' => 'auth_key'
                ]));
                $model->updateAttributes(['auth_key' => null]);

                Log::create(Log::TYPE_AUTH, 'USER_AUTH_LOGOUT_{id}', [
                    'id' => Yii::$app->user->id
                ], [], [], [], $model->id);

                Yii::$app->user->switchIdentity($model);
                return $this->redirect(['/backend/users/default/view', 'id' => $user_id]);
            }
        }

        Yii::$app->user->logout();
        return $this->redirect(['/']);
    }



    /**
     * Открытие страницы регистрации и сохранение результатов регистрации
     * @return string
     */
    public function actionRegistration()
    {
        $model = new Users(['scenario' => Users::SCENARIO_REGISTRATION]);

        if ($model->load(Yii::$app->request->post()) && $model->save()){
            /**
             * Отправляем цель в метрику
             */
            //Yii::$app->session->setFlash('goal_registration');

            Yii::$app->user->login($model, Yii::$app->params['loginDuration']); // сразу логиним юзера

            $this->layout = 'empty';
            return $this->render('reg-success', ['model' => $model]); // /common/modules/users/views/frontend/default/reg-success.php
        }

        $this->layout = 'empty';
        return $this->render('registration', ['model' => $model]); // /common/modules/users/views/frontend/default/registration.php
    }



    /**
     * Страница просмотра команды
     *
     * @param $organisation_id
     * @return string
     */
    public function actionTeam($organisation_id)
    {
        $orgModel = Organisations::findModel($organisation_id);
        $ownProfileModel = $orgModel->ownOrgProfile; // свой профиль в этой организации

        $profileModel = new Profiles();
        $profiles = Profiles::find()
            ->joinWith('user')
            ->where(['org_id' => $orgModel->id])
            ->all();

        return $this->render('team', [
            'orgModel'         => $orgModel,
            'profileModel'     => $profileModel, // пустая
            'ownProfileModel'  => $ownProfileModel,
            'canCreateProfile' => Profiles::canCreateProfile($orgModel),
            'profiles'         => $profiles
        ]);

    }



    /**
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionBan()
    {
        if (Yii::$app->user->identity->ban_exists != 1){
            throw new NotFoundHttpException(Yii::t('app', 'ERROR_404'));
        }

        $this->layout = 'empty';
        return $this->render('ban', [
            'model' => Yii::$app->user->identity
        ]);
    }



    /**
     * Подтверждение emaila при переходе по ссылке активации
     *
     * @param $code
     * @return yii\web\Response
     */
    public function actionActivate($code)
    {
        $model = $this->findActivateModel($code);
        $model->activateAccount();

        /**
         * Отправляем цель в метрику
         */
        Yii::$app->session->setFlash('goal_activate_account');
        Yii::$app->session->setFlash('success', Module::t('main', 'MESSAGE_ACTIVATE_ACCOUNT_SUCCESS'));

        return $this->redirect(['/profile']);
    }



    /**
     * Повторная отправка письма активации емайла
     * запрашивается по ajax
     * @return array
     */
    public function actionResendActivation()
    {
        Yii::$app->response->format = yii\web\Response::FORMAT_JSON; /* клиент принимает ответ в json */

        $model = Yii::$app->user->identity;
        /* @var $model Users */
        if ($model->activate_time) {
            return [
                'status' => 'error',
                'text'   => 'Ваша почта уже активирована. Обновите страницу.'
            ];
        }

        $model->sendActivateMail();

        return [
            'status' => 'success',
            'text'   => 'Мы отправили еще одно письмо для подтверждения почты. В течении нескольких минут письма обычно бывают доставлены. Проверьте папку "спам". 
            
            Если письмо так и не пришло после нескольких попыток - просим сообщить нам.'
        ];
    }



    /**
     * @return string
     */
    public function actionPasswordRecovery()
    {
        $this->layout = 'empty';
        $model = new PasswordRecovery([
            'scenario' => PasswordRecovery::SCENARIO_REQUEST
        ]);

        if ($model->load(Yii::$app->request->post()) && $model->sendMail()){
            return $this->render('password-recovery-send', [
                'model' => $model
            ]);
        }

        return $this->render('password-recovery', [
            'model' => $model
        ]);
    }



    /**
     * @param $code
     * @return string|yii\web\Response
     */
    public function actionSetPassword($code)
    {
        $this->layout = 'empty';
        $model = $this->findRecoveryModel($code);

        if ($model->load(Yii::$app->request->post()) && $model->setPassword()){
            Yii::$app->session->setFlash('success', Module::t('main', 'MESSAGE_RECOVERY_PASSWORD_SUCCESS'));
            return $this->redirect(['login']);
        }

        return $this->render('set-password', [
            'model' => $model
        ]);
    }



    /**
     * @param $code
     * @return string
     */
    public function actionUnsubscribeNews($code)
    {
        if (Yii::$app->user->isGuest){
            $view         = 'unsubscribe-news-guest';
            $this->layout = 'empty';
        }else{
            $view = 'unsubscribe-news';
        }

        $model = $this->findSubscribeNews($code);

        if (Yii::$app->request->isPost){
            $model->unsubscribeNews();
            Yii::$app->session->setFlash('success', Module::t('main', 'MESSAGE_UNSUBSCRIBE_NEWS_CONFIRM_SUCCESS'));

            return $this->redirect(['/']);
        }

        return $this->render($view, [
            'model' => $model
        ]);
    }



    /**
     * @param $code
     * @return string
     */
    public function actionUnsubscribeNotifications($code)
    {
        if (Yii::$app->user->isGuest){
            $view         = 'unsubscribe-notifications-guest';
            $this->layout = 'empty';
        }else{
            $view = 'unsubscribe-notifications';
        }

        $model = $this->findSubscribeNotifications($code);

        if (Yii::$app->request->isPost){
            $model->unsubscribeNotifications();
            Yii::$app->session->setFlash('success', Module::t('main', 'MESSAGE_UNSUBSCRIBE_NOTIFICATIONS_CONFIRM_SUCCESS'));

            return $this->redirect(['/']);
        }

        return $this->render($view, [
            'model' => $model
        ]);
    }



    /**
     * Выбор текущей организации
     * @param $id
     * @return yii\web\Response
     */
    public function actionSetCurrentOrganisation($id){
        $organisation = Organisations::findOne($id);
        $user = Yii::$app->user->identity;
        if ($organisation->canSetCurrentOrg()){ // todo: убогая проверка на то может ли юзер взять текущую организацию или нет
            $user->current_organisation = $id; // todo: сделать защиту
            $user->save();
            Yii::$app->session->setFlash('success', 'Текущая организация: ' . $organisation->brand);
            return $this->redirect('/my-organisations');
        } else {
            Yii::$app->session->setFlash('error', 'Вы не можете выбрать организацию: ' . $organisation->brand);
            return $this->redirect('/my-organisations');
        }

    }



    /**
     * Загрузка содержимого модального окна аватара профиля
     * запрашивается по Ajax, сохранение картинки аватара - в другом методе. Это просто интерфейс
     * @return string
     */
    public function actionUserAvatarModal()
    {
        $model = Yii::$app->user->identity;
        return $this->renderAjax('_user-avatar-modal', [
            'model' => $model
        ]);
    }



    /**
     *
     * @var $model Users
     * @return array
     */
    public function actionSaveAvatar()
    {
        Yii::$app->response->format = yii\web\Response::FORMAT_JSON; /* клиент принимает ответ в json */
        $model =  Yii::$app->user->identity; //Users::findOne(['id' => Yii::$app->user->identity->id])->scenario(Users::SCENARIO_AVATAR);
        /* @var $model Users */
        $model->scenario = Users::SCENARIO_AVATAR;

        if (Yii::$app->request->isPost) {
            $model->image_avatar = yii\web\UploadedFile::getInstance($model, 'image_avatar'); // выгружаем массив с данными о загруженном файле

            if ($model->validate()) {
                $deleteResult = $model->deleteAvatar(); // пытаемся удалить старую аватарку
                $model->avatar = Yii::$app->formatter->nameFromId($model->id) . '.jpg'; // просто формируем новое имя аватарки
                $model->saveAvatarImages(); // нарезка табнейла и сохранение в директорию

                // принудительное обновление атрибута аватарки, а то не обновляет почему то при сценарии с аватаркой
                $update_attributes_result = $model->updateAttributes(['avatar']);
                if ($model->save()) {
                    return [
                        'status' => 'success',
                        'text'   => 'Фотография профиля успешно сохранена',
                        //'ava' => Yii::$app->formatter->nameFromId($model->id) . '.jpg', // это для дебага - если потребуется раскомментить
                        //'delete_result' => $deleteResult,
                        //'update_attributes_result' => $update_attributes_result
                    ];
                }
                return [
                    'status' => 'error',
                    'text'   => 'ошибка сохранения модели',
                    'errors_list' => $model->getErrors()
                ];
            } else {
                return [
                    'status' => 'error',
                    'text'   => 'Ошибка валидации',
                    'errors_list' => $model->getErrors()
                ];
            }

        } else {
            return [
                'status' => 'error',
                'errors_list'   => [
                    'image_avatar' => ['Изображение не отправлено.']
                ]
            ];
        }
    }



    /**
     * Возвращает контейнер с фото пользователя в профиле
     * запрашивается по ajax, нужен что бы обновить фото профиля после загрузки нового фото
     * @return string
     */
    public function actionRefreshAvatarContainer()
    {
        return $this->renderPartial('_profile-avatar-container', [
            'model' => Yii::$app->user->identity]
        );
    }



    /**
     * @param $code
     * @return PasswordRecovery
     * @throws ForbiddenHttpException
     */
    protected function findRecoveryModel($code)
    {
        $user = Users::findOne(['recovery_code' => $code]);

        if ($user === null){
            throw new ForbiddenHttpException(Module::t('main', 'MESSAGE_RECOVERY_PASSWORD_CODE_NOT_FOUND'));
        }elseif ($user->recovery_time + Yii::$app->params['expireRecovery'] <= time()){
            throw new ForbiddenHttpException(Module::t('main', 'MESSAGE_RECOVERY_PASSWORD_CODE_EXPIRE'));
        }

        $model = new PasswordRecovery([
            'user' => $user,
            'scenario' => PasswordRecovery::SCENARIO_SET
        ]);

        return $model;
    }

    /**
     * @param $code
     * @return Users
     * @throws ForbiddenHttpException
     */
    protected function findActivateModel($code)
    {
        $model = Users::findOne(['activate_code' => $code]);

        if ($model === null){
            throw new ForbiddenHttpException(Module::t('main', 'MESSAGE_ACTIVATE_ACCOUNT_CODE_NOT_FOUND'));
        }

        return $model;
    }

    /**
     * @param $code
     * @return Users
     * @throws ForbiddenHttpException
     */
    protected function findSubscribeNews($code)
    {
        $model = Users::findOne(['subscribe_news' => $code]);

        if ($model === null){
            throw new ForbiddenHttpException(Module::t('main', 'MESSAGE_SUBSCRIBE_NEWS_CODE_NOT_FOUND'));
        }

        return $model;
    }

    /**
     * @param $code
     * @return Users
     * @throws ForbiddenHttpException
     */
    protected function findSubscribeNotifications($code)
    {
        $model = Users::findOne(['subscribe_notifications' => $code]);

        if ($model === null){
            throw new ForbiddenHttpException(Module::t('main', 'MESSAGE_SUBSCRIBE_NOTIFICATIONS_CODE_NOT_FOUND'));
        }

        return $model;
    }
}