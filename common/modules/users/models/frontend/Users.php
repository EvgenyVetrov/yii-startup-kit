<?php

namespace modules\users\models\frontend;

use yii;
use yii\helpers\Url;
use modules\users\Module;
use yii\helpers\ArrayHelper;
use common\components\SendMail;
use common\behaviors\UploadImage;
use modules\users\models\BaseUsers;
use common\components\SendNotification;
use modules\users\behaviors\LogBehavior;
use himiklab\yii2\recaptcha\ReCaptchaValidator;
use modules\organisations\models\BaseOrganisations;

/**
 * Class Users
 * @package modules\users\models\frontend
 */
class Users extends BaseUsers {

    const SCENARIO_REGISTRATION = 'registration'; // Сценарий регистрации нового пользователя.
    const SCENARIO_PROFILE      = 'profile';      // Сценарий изменения настроек профиля
    const SCENARIO_AVATAR       = 'avatar';       // Сценарий загрузки аватарки ибо аватарку грузить отдельно надо

    /**
     * Текущий пароль
     * @var
     */
    public $password_old;
    /**
     * Новый пароль
     * @var
     */
    public $password_new;
    /**
     * Повторение пароля.
     * @var
     */
    public $password_repeat;
    /**
     * Смена email
     * @var bool
     */
    public $change_email = false;
    /**
     * Смена email
     * @var bool
     */
    private $contacts_info = false;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return ArrayHelper::merge(parent::rules(), [
            // Scenario profile
            ['password_old',
                'isOldPassword'
            ],
            ['password_new',
                'string',
                'min' => 6,
                'max' => 255,
                'skipOnEmpty' => false,
                'when' => function ($model){
                    /* @var $model self */
                    return empty($model->password_old) === false;
                },
                'whenClient' => 'function (attribute, value) {
                    return $("#users-password_old").val() != "";
                }'
            ],
            ['password_repeat',
                'compare',
                'skipOnEmpty' => false,
                'compareAttribute' => 'password_new',
                'on' => self::SCENARIO_PROFILE,
                'message' => Module::t('main', 'ERROR_COMPARE_PASSWORD'),
                'when' => function ($model){
                    /* @var $model self */
                    return empty($model->password_new) === false;
                },
                'whenClient' => 'function (attribute, value) {
                    return $("#users-password_new").val() != "";
                }'
            ],

            // Scenario registration
            ['password_repeat',
                'compare',
                'skipOnEmpty' => false,
                'compareAttribute' => 'password',
                'on' => self::SCENARIO_REGISTRATION,
                'message' => Module::t('main', 'ERROR_COMPARE_PASSWORD'),
            ],
            /*[
                'avatar',
                'image',
                'minSize' => 1024 * 30,
                'maxSize' => 1024 * 1024 * 2
            ]*/

            // Captcha
            //['captcha', ReCaptchaValidator::className(), 'secret' => Yii::$app->reCaptcha->secret],

/*            ['subscribe_news',
                'boolean'
            ],
            ['subscribe_notifications',
                'boolean'
            ],*/
        ]);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return ArrayHelper::merge(parent::attributeLabels(), [
            'password_old'    => Module::t('main', 'ATTR_PASSWORD_OLD'),
            'password_new'    => Module::t('main', 'ATTR_PASSWORD_NEW'),
            'password_repeat' => Module::t('main', 'ATTR_PASSWORD_REPEAT')
        ]);
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'log' => [
                'class' => LogBehavior::class,
                'types' => [
                    'update' => ['UPDATE_PROFILE'],
                ]
            ],
            'upload' => [
                'class'     => UploadImage::class,
                'attribute' => 'avatar',
                'crop'      => true,
                'scenarios' => [self::SCENARIO_AVATAR],
                'path'      => '@files/users/avatars/'    . Yii::$app->formatter->idToPath($this->id), // куда будут сохраняться картинки
                'url'       => '@urlFiles/users/avatars/' . Yii::$app->formatter->idToPath($this->id),
                'thumbs' => [
                    'thumb' => ['width' => 50, 'height' => 50],
                    'ava'   => ['width' => 400, 'height' => 400, 'quality' => 85],
                ],
                'generateNewName' => function (){
                    return Yii::$app->formatter->nameFromId($this->id) . '.jpg';
                }
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        return [
            static::SCENARIO_DEFAULT => [],
            static::SCENARIO_PROFILE => [
                'first_name',
                'last_name',
                'patronymic',
                'contacts',
                'phone',
                //'avatar',
                'email',
                'password_old',
                'password_new',
                'password_repeat',
                //'subscribe_news',
                //'subscribe_notifications',
            ],
            static::SCENARIO_AVATAR => [ // отдельный сценарий для загрузки аватарки
                'avatar',
                'image_avatar'
            ],
            static::SCENARIO_REGISTRATION => [
                'first_name',
                'last_name',
                'email',
                'password',
                'password_repeat',
                'captcha'
            ],
        ];
    }



    /**
     * Возвращает содержимое svg файла заглушки для аватара.
     * Да да, заглушки должны быть в svg формате
     *
     * @return bool|string
     */
    public static function getBlankAvatar() {
        return file_get_contents(Yii::getAlias('@frontend').'/web/img/blanks/avatar.svg');
    }



    /**
     * @inheritdoc
     */
    public function beforeSave($insert)
    {
        if ($this->isNewRecord){
            $this->saveUtmData();
            $this->error_count_auth = 0;
            $this->time_registration = time();
            $this->time_last_visit = time();
            $this->password = Yii::$app->security->generatePasswordHash($this->password);
        }else if (empty($this->password_new) === false){
            $this->password = Yii::$app->security->generatePasswordHash($this->password_new);
        }

        if ($this->getOldAttribute('email') != $this->email){
            $this->change_email = true;

            /**
             * Генерируем код активации
             */
            $this->activate_code = Yii::$app->security->generateRandomString();
            $this->activate_time = 0;
        }

        if ($this->scenario == self::SCENARIO_PROFILE){
            /**
             * Генерируем/убираем код отписки от рассылки новостей
             */
            if ($this->getOldAttribute('subscribe_news') === null && $this->subscribe_news == 1){
                $this->generateSubscribeNewsCode();
            }elseif ($this->getOldAttribute('subscribe_news') !== null && $this->subscribe_news == 0){
                $this->subscribe_news = null;
            }else{
                $this->subscribe_news = $this->getOldAttribute('subscribe_news');
            }

            /**
             * Генерируем/убираем код отписки от рассылки оповещений
             */
            if ($this->getOldAttribute('subscribe_notifications') === null && $this->subscribe_notifications == 1){
                $this->generateSubscribeNotificationsCode();
            }elseif ($this->getOldAttribute('subscribe_notifications') !== null && $this->subscribe_notifications == 0){
                $this->subscribe_notifications = null;
            }else{
                $this->subscribe_notifications = $this->getOldAttribute('subscribe_notifications');
            }
        }

        return parent::beforeSave($insert);
    }

    /**
     * @param bool $insert
     * @param array $changedAttributes
     */
    public function afterSave($insert, $changedAttributes)
    {
        /**
         * Отправляем письмо с активацией
         */
        if ($this->change_email){
            $this->sendActivateMail();
        }

        /**
         * Отправляем оповещение о регистрации
         * Раньше Андрей сделал чтоб ему в вк оповещения приходили о новых юзерах, но пока это не нужно
         */
        /*if ($this->scenario == self::SCENARIO_REGISTRATION){
            $this->sendNotification();
        }*/

        parent::afterSave($insert, $changedAttributes);
    }

    /**
     * @param $attribute
     * @param array $params
     */
    public function isOldPassword($attribute, $params = [])
    {
        if (Yii::$app->security->validatePassword($this->{$attribute}, $this->password) === false) {
            $this->addError($attribute, Module::t('main', 'ERROR_INCORRECT_PASSWORD_OLD'));
        }
    }

    /**
     * @inheritdoc
     */
    public function activateAccount()
    {
        $old = $this->oldAttributes;

        parent::activateAccount();

        Log::create(
            Log::TYPE_UPDATE,
            'ACTIVATE_ACCOUNT',
            [],
            $old,
            $this->attributes,
            [],
            $this->id
        );

//        $this->sendRecommendationEmail();

        if (Yii::$app->user->isGuest){
            Yii::$app->user->login($this, Yii::$app->params['loginDuration']);
        }
    }

    /**
     * Отписываемся от новостей
     */
    public function unsubscribeNews()
    {
        $old = $this->oldAttributes;

        $this->subscribe_news = null;
        $this->detachBehavior('log');

        if ($this->save()){
            Log::create(
                Log::TYPE_UPDATE,
                'UNSUBSCRIBE_NEWS',
                [],
                $old,
                $this->attributes,
                [],
                $this->id
            );
        }
    }

    /**
     * Отписываемся от новостей
     */
    public function unsubscribeNotifications()
    {
        $old = $this->oldAttributes;

        $this->subscribe_notifications = null;
        $this->detachBehavior('log');

        if ($this->save()){
            Log::create(
                Log::TYPE_UPDATE,
                'UNSUBSCRIBE_NOTIFICATIONS',
                [],
                $old,
                $this->attributes,
                [],
                $this->id
            );
        }
    }

    /**
     * Сохраняем в куки utm метки
     */
    public function hundlerUtmData()
    {
        $data         = null;
        $utm_source   = Yii::$app->request->get('utm_source');
        $utm_medium   = Yii::$app->request->get('utm_medium');
        $utm_campaign = Yii::$app->request->get('utm_campaign');
        $utm_term     = Yii::$app->request->get('utm_term');
        $utm_content  = Yii::$app->request->get('utm_content');

        if ($utm_source === null || $utm_medium === null || $utm_campaign === null){
            return;
        }

        $data = [
            'utm_source'   => $utm_source,
            'utm_medium'   => $utm_medium,
            'utm_campaign' => $utm_campaign,
        ];

        if ($utm_term !== null){
            $data['utm_term'] = $utm_term;
        }
        if ($utm_content !== null){
            $data['utm_content'] = $utm_content;
        }

        if ($data !== null){
            setcookie('utm_data', json_encode($data), time() + 86400 * 365);
        }
    }

    /**
     * Сохраняем utm метки в профиль пользователя
     */
    protected function saveUtmData()
    {
        $data = isset($_COOKIE['utm_data']) ? json_decode($_COOKIE['utm_data'], true) : null;

        if (
            is_array($data) === false ||
            isset($data['utm_source'], $data['utm_medium'], $data['utm_campaign']) === false ||
            empty($data['utm_source']) ||
            empty($data['utm_medium']) ||
            empty($data['utm_campaign'])
        ){
            return;
        }

        setcookie('utm_data', null, -1);

        $this->utm_source   = $data['utm_source'];
        $this->utm_medium   = $data['utm_medium'];
        $this->utm_campaign = $data['utm_campaign'];

        if (isset($data['utm_term']) && empty($data['utm_term']) === false){
            $this->utm_term = $data['utm_term'];
        }
        if (isset($data['utm_content']) && empty($data['utm_content']) === false){
            $this->utm_content = $data['utm_content'];
        }
    }

    /**
     * Отправляем оповещение
     * Оповещение отправлялось раньше админу, в вк Андрею о новом юзере отправлялось, щас пока не нужно
     */
    protected function sendNotification()
    {
        $message =
            'Регистрация нового пользователя' . PHP_EOL .
            'Имя: ' . $this->first_name . PHP_EOL .
            'Email: ' . $this->email;

        if ($this->utm_source){
            $message .= PHP_EOL . PHP_EOL;
            $message .= $this->getAttributeLabel('utm_source') . ': ' . $this->utm_source . PHP_EOL;
            $message .= $this->getAttributeLabel('utm_medium') . ': ' . $this->utm_medium . PHP_EOL;
            $message .= $this->getAttributeLabel('utm_campaign') . ': ' . $this->utm_campaign;

            if ($this->utm_term){
                $message .= PHP_EOL;
                $message .= $this->getAttributeLabel('utm_term') . ': ' . $this->utm_term;
            }
            if ($this->utm_content){
                $message .= PHP_EOL;
                $message .= $this->getAttributeLabel('utm_content') . ': ' . $this->utm_content;
            }
        }

        $notification = new SendNotification();
        $notification->chat_id = SendNotification::CHAT_REGISTRATION;
        $notification->message = $message;
        $notification->send();
    }

    /**
     * Отправляем письмо с ссылкой для активации аккаунта
     */
    public function sendActivateMail()
    {
        $activateUrl = Url::to(['/users/default/activate', 'code' => $this->activate_code], true);

        /**
         * Html версия письма
         */
        $html = Yii::$app->view->renderFile('@common/mail/registration-html.php', [
            'activateUrl' => $activateUrl
        ]);
        /**
         * Текстовая версия письма
         */
        $text = Yii::$app->view->renderFile('@common/mail/registration-text.php', [
            'activateUrl' => $activateUrl
        ]);

        $mail = new SendMail();
        $mail->html    = $html;
        $mail->text    = $text;
        $mail->to      = $this->email;
        $mail->subject = Module::t('main',  'TITLE_ACTIVATE_ACCOUNT');

        $mail->send();
    }

    /**
     * Отправляем письмо с рекомендациями по продвижению в Инстаграм
     */
    protected function sendRecommendationEmail()
    {
        $unsubscribeUrl = Url::to([
            '/users/default/unsubscribe-notifications',
            'code' => $this->subscribe_notifications
        ],true);

        /**
         * Html версия письма
         */
        $html = Yii::$app->view->renderFile('@common/mail/recommendation-html.php', [
            'unsubscribeUrl' => $unsubscribeUrl
        ]);
        /**
         * Текстовая версия письма
         */
        $text = Yii::$app->view->renderFile('@common/mail/recommendation-text.php', [
            'unsubscribeUrl' => $unsubscribeUrl
        ]);

        $mail = new SendMail();
        $mail->html    = $html;
        $mail->text    = $text;
        $mail->to      = $this->email;
        $mail->subject = 'Рекомендации после регистрации';

        $mail->send();
    }
}