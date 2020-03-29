<?php

namespace modules\users;

use yii;
use yii\helpers\Url;
use yii\base\BootstrapInterface;
use modules\users\models\frontend\Users;

/**
 * Class Bootstrap
 * @package modules\users
 */
class Bootstrap implements BootstrapInterface
{
    /**
     * @inheritdoc
     */
    public function bootstrap($app)
    {
        (new Module('users'))->init();

        if ($app->id === 'frontend'){
            $rules['ban']                                    = 'users/default/ban';
            $rules['user/<id:(\d+)>']                        = 'users/default/view'; // просмотр странички другого пользователя
            $rules['login']                                  = 'users/default/login';
            $rules['logout']                                 = 'users/default/logout';
            $rules['profile']                                = 'users/default/profile'; // просмотр настроек своего профиля
            $rules['user/resend-activation']                 = 'users/default/resend-activation'; // повторная отправка письма подтверждения емайла
            $rules['user/devices']                           = 'users/default/devices';
            $rules['registration']                           = 'users/default/registration';
            $rules['user/devices/clear']                     = 'users/default/devices-clear';
            $rules['user/devices/delete/<id:(.*)>']          = 'users/default/devices-delete';
            $rules['password-recovery']                      = 'users/default/password-recovery';
            $rules['user/activate/<code:(.*)>']              = 'users/default/activate';
            $rules['password-set/<code:(.*)>']               = 'users/default/set-password';
            $rules['unsubscribe-news/<code:(.*)>']           = 'users/default/unsubscribe-news';
            $rules['unsubscribe-notifications/<code:(.*)>']  = 'users/default/unsubscribe-notifications';


            $rules['users/default/user-avatar-modal']        = 'users/default/user-avatar-modal'; // вызов и загрузка модального окна для выбора аватарки
            $rules['users/default/save-avatar']              = 'users/default/save-avatar'; // отправка изображения сохранения аватара
            $rules['users/default/refresh-avatar-container'] = 'users/default/refresh-avatar-container'; // отправка изображения сохранения аватара

            $this->updateUserData();
            $app->urlManager->addRules($rules, false);

            if (
                Yii::$app->user->isGuest === false &&
                Yii::$app->user->identity->ban_exists == 1 &&
                in_array(Yii::$app->request->pathInfo, ['ban', 'logout', 'debug/default/toolbar']) === false
            ){
                header('Location: ' . Url::to(['/users/default/ban']));
                exit;
            }
        }
    }

    /**
     * Обновляем данные пользователя
     */
    protected function updateUserData()
    {
        if (Yii::$app->user->isGuest){
            (new Users())->hundlerUtmData();
        }else{
            Yii::$app->user->identity->updateDataAction();
        }
    }
}