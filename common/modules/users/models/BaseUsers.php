<?php

namespace modules\users\models;

use yii;
use modules\users\Module;
use yii\web\IdentityInterface;
use yii\web\NotFoundHttpException;
use modules\users\models\frontend\Users;
use modules\organisations\models\BaseOrganisations;

/**
 * This is the model class for table "{{%users}}".
 *
 * @property integer $id
 * @property string  $auth_key
 * @property string  $email
 * @property string  $password
 * @property string  $first_name
 * @property string  $last_name
 * @property string  $patronymic
 * @property string  $contacts
 * @property string  $avatar
 * @property string  $image_avatar - виртуальное свойство для хранения объекта картинки при загрузке
 * @property string  $phone
 * @property string  $role
 * @property integer $error_count_auth
 * @property integer $time_registration
 * @property integer $time_last_visit
 * @property string  $activate_code
 * @property integer $activate_time
 * @property string  $recovery_code
 * @property integer $recovery_time
 * @property string  $subscribe_news
 * @property string  $subscribe_notifications
 * @property string  $utm_source
 * @property string  $utm_medium
 * @property string  $utm_campaign
 * @property string  $utm_term
 * @property string  $utm_content
 * @property integer $ban_exists
 * @property string  $ban_description
 * @property string  $ip
 * @property string  $ua
 */

class BaseUsers extends yii\db\ActiveRecord implements IdentityInterface
{
    /**
     * Капча
     * @var
     */
    public $captcha;

    /**
     * Загружаемое изображение аватара
     * @var
     */
    public $image_avatar;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%users}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            /* фильтры */
            [['first_name', 'last_name', 'patronymic', 'email', 'phone'], 'filter', 'filter' => function($value) {
                return Yii::$app->formatter->clearData($value, 'simple_string');
            }],
            [['contacts'], 'filter', 'filter' => function($value) {
                return Yii::$app->formatter->clearData($value, 'simple_html');
            }],
            [['ua'], 'filter', 'filter' => function($value) {
                return mb_substr($value, 0, 250);
            }],


            /* валидаторы */
            [['first_name', 'email', 'password'], 'required'],
            [['email'], 'email',
                'message' => Module::t('main', 'ERROR_INCORRECT_EMAIL')
            ],
            [['password'], 'string', 'min' => 6, 'max' => 255,
                'message'  => Module::t('main', 'ERROR_INCORRECT_PASSWORD'),
                'tooShort' => Module::t('main', 'ERROR_SHORT_PASSWORD'),
                'tooLong'  => Module::t('main', 'ERROR_LONG_PASSWORD'),
            ],
            [['first_name'], 'string', 'max' => 50,
                'message'    => Module::t('main', 'ERROR_INCORRECT_NAME'),
                'tooLong'    => Module::t('main', 'ERROR_LONG_NAME'),
            ],
            [['last_name'], 'string', 'max' => 50,
                'message'    => Module::t('main', 'ERROR_INCORRECT_LAST_NAME'),
                'tooLong'    => Module::t('main', 'ERROR_LONG_LAST_NAME'),
            ],
            [['patronymic'], 'string', 'max' => 50,
                'message'    => Module::t('main', 'ERROR_INCORRECT_PATRONYMIC'),
                'tooLong'    => Module::t('main', 'ERROR_LONG_PATRONYMIC'),
            ],
            [['email'], 'unique',
                'message'    => Module::t('main', 'ERROR_EXISTS_EMAIL'),
            ],

            [['avatar'], 'string', 'max' => 50, 'on' => Users::SCENARIO_AVATAR],
            [['current_organisation'], 'integer'],
            [['image_avatar'], 'image', 'on' => Users::SCENARIO_AVATAR,
                'skipOnEmpty' => false,
                'extensions'  => 'png, jpg',
                'maxSize'     => 1 * 1024 * 1024, // 1 mb max
                'minWidth'    => 500,
                'minHeight'   => 500,
            ],
            [['image'], 'image', 'extensions' => 'png, jpg'], // не используется наверно уже это jn оСкщз вроде осталось
            //[['role'], 'string', 'max' => 25],
        ];
    }


    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'                       => Module::t('main', 'ATTR_ID'),
            'email'                    => Module::t('main', 'ATTR_EMAIL'),
            'password'                 => Module::t('main', 'ATTR_PASSWORD'),
            'first_name'               => Module::t('main', 'ATTR_NAME'),
            'last_name'                => Module::t('main', 'ATTR_LAST_NAME'),
            'patronymic'               => Module::t('main', 'ATTR_PATRONYMIC'),
            'contacts  '               => Module::t('main', 'ATTR_CONTACTS'),
            'phone'                    => Module::t('main', 'ATTR_PHONE'),
            'role'                     => Module::t('main', 'ATTR_ROLE'),
            'avatar'                   => Module::t('main', 'ATTR_AVATAR'),
            'time_registration'        => Module::t('main', 'ATTR_TIME_REGISTRATION'),
            'time_last_visit'          => Module::t('main', 'ATTR_TIME_LAST_VISIT'),
            'activate_time'            => Module::t('main', 'ATTR_ACTIVATE_TIME'),
            'subscribe_news'           => Module::t('main', 'ATTR_SUBSCRIBE_NEWS'),
            'subscribe_notifications'  => Module::t('main', 'ATTR_SUBSCRIBE_NOTIFICATIONS'),
            'captcha'                  => Module::t('main', 'ATTR_CAPTCHA'),
            'utm_source'               => Module::t('main', 'ATTR_UTM_SOURCE'),
            'utm_medium'               => Module::t('main', 'ATTR_UTM_MEDIUM'),
            'utm_campaign'             => Module::t('main', 'ATTR_UTM_CAMPAIGN'),
            'utm_term'                 => Module::t('main', 'ATTR_UTM_TERM'),
            'utm_content'              => Module::t('main', 'ATTR_UTM_CONTENT'),
            'ban_exists'               => Module::t('main', 'ATTR_BAN_EXISTS'),
            'ban_description'          => Module::t('main', 'ATTR_BAN_DESCRIPTION'),
            'ip'                       => Module::t('main', 'ATTR_IP'),
            'ua'                       => Module::t('main', 'ATTR_UA'), // юзерагент
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return self::findOne($id);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return self::findOne(['auth_key' => $token]);
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }


    /**
     * Связь с профилем в текущей организации
     * @return $this
     */
    public function getCurrentOrgProfile()
    {
        return $this->hasOne(BaseProfiles::class, ['org_id' => 'id'])->andWhere(['user_id' => $this->id]);
    }


    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Генерируем Auth Key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * @inheritdoc
     */
    public function beforeSave($insert)
    {
        /**
         * Генерируем код отписки от рассылки новостей
         */
        if ($this->isNewRecord){
            $this->generateSubscribeNewsCode();
        }elseif ($this->getOldAttribute('password') != $this->password){
            $this->resetAuth();
        }

        /**
         * Генерируем код отписки от рассылки оповещений
         */
        if ($this->isNewRecord){
            $this->generateSubscribeNotificationsCode();
        }

        return parent::beforeSave($insert);
    }

    /**
     * Активация учетной записи
     */
    public function activateAccount()
    {
        $this->activate_code = null;
        $this->activate_time = time();
        $this->detachBehavior('log');
        $this->save(0);
    }

    /**
     * Обновляем время последнего посещения, User Agent и IP адрес.
     */
    public function updateDataAction()
    {
        $this->updateAttributes([
            'time_last_visit' => time(),
            'ip' => Yii::$app->request->userIP,
            'ua' => Yii::$app->request->userAgent,
        ]);
    }



    /**
     * Метод удаления аватара и тубнейла
     * Удаление именно картинок, а не записи из базы
     * @return array
     */
    public function deleteAvatar()
    {
        $resultStatus = 'success';
        $errors_list  = [];
        if ($this->avatar) {
            /* удаление аватара */
            $avaPath = $this->getAvatarPath('full').'/ava-'.$this->avatar;
            if (file_exists($avaPath)) {
                $unlinkAva = unlink($avaPath);
                if (!$unlinkAva) {
                    $errors_list[] = 'Ошибка удаления файла: ' . $avaPath; // это клиенту не показывается, просто на случай дебага
                    $resultStatus  = 'error';
                }
            } else {
                $errors_list[] = 'Файл: ' . $avaPath . ' - не существует.'; // это клиенту не показывается, просто на случай дебага
                $resultStatus  = 'error';
            }

            /* удаление тубнейла */
            $thumbPath = $this->getAvatarPath('full').'/thumb-'.$this->avatar;
            if (file_exists($thumbPath)) {
                $unlinkThumb = unlink($thumbPath);
                if (!$unlinkThumb) {
                    $errors_list[] = 'Ошибка удаления файла: ' . $thumbPath; // это клиенту не показывается, просто на случай дебага
                    $resultStatus  = 'error';
                }
            } else {
                $errors_list[] = 'Файл: ' . $thumbPath . ' - не существует.'; // это клиенту не показывается, просто на случай дебага
                $resultStatus  = 'error';
            }
        } else {
            $errors_list[] = 'Изначально нет аватара'; // это клиенту не показывается, просто на случай дебага
            $resultStatus  = 'error';
        }

        //if ($resultStatus == 'success') { $this->avatar = ''; } // очищаем свойство. При случайном сохранении модели - сохранится как надо

        return [
            'status'      => $resultStatus,
            'errors_list' => $errors_list // это клиенту не показывается, просто на случай дебага
        ];
    }


    /**
     * Сохранение картинок аватара.
     * Нарезка, сжатие - всё тут
     */
    public function saveAvatarImages()
    {
        $path = $this->getAvatarPath('full');
        yii\helpers\FileHelper::createDirectory($path);

        // сохраняем тубнейл
        yii\imagine\Image::thumbnail($this->image_avatar->tempName, 100, 100)
            ->save($this->getAvatarPath('full') . '/thumb-' . $this->avatar, ['quality' => 90 ]);

        // сохраняем основную аву
        yii\imagine\Image::thumbnail($this->image_avatar->tempName, 500, 500)
            ->save($this->getAvatarPath('full') . '/ava-' . $this->avatar, ['quality' => 90 ]);
    }



    /**
     * Возвращает строку (путь) куда сохранять или откуда брать аватар.
     * Путь именно до папки, где лежит файл, а не до конечного файла. Без / в конце
     *
     * @param string $mode - 2 режима: полный путь операционной системы и алас yii фреймворка
     * @return string
     */
    public function getAvatarPath($mode = 'alias')
    {
        if ($mode == 'full') {
            return Yii::getAlias('@files') . '/users/avatars/' . Yii::$app->formatter->idToPath($this->id);
        }
        if ($mode == 'alias') {
            return '@files/users/avatars/' . Yii::$app->formatter->idToPath($this->id);
        }
        if ($mode == 'web') {
            return '/files/users/avatars/' . Yii::$app->formatter->idToPath($this->id);
        }
    }


    /**
     * Сбрасываем авторизацию
     * @param bool $session_id
     * @param bool $save
     */
    public function resetAuth($session_id = null, $save = false)
    {
        $this->generateAuthKey();

        $where = ['user_id' => $this->id];

        if ($session_id !== null){
            $where['id'] = $session_id;
        }

        Yii::$app->db->createCommand()
            ->delete(Yii::$app->session->sessionTable, $where)
            ->execute();

        if ($save === true){
            $this->save();
        }
    }



    /**
     * Поиск модели и обработка эксцепшенов
     * чтоб каждый раз не писать в контроллерах этот метод
     *
     * @param $user_id
     * @return null|static
     * @throws NotFoundHttpException
     */
    public static function findModel($user_id) {
        if (($model = self::findOne($user_id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('Пользователя #'. $user_id .' не существует');
        }
    }



    /**
     * Генерируем код отписки от рассылки новостей
     */
    protected function generateSubscribeNewsCode()
    {
        $this->subscribe_news = md5(
            $this->id .
            '|' .
            microtime(true) .
            Yii::$app->security->generateRandomString()
        );
    }

    /**
     * Генерируем код отписки от рассылки оповещений
     */
    protected function generateSubscribeNotificationsCode()
    {
        $this->subscribe_notifications = md5(
            $this->id .
            '|' .
            microtime(true) .
            Yii::$app->security->generateRandomString()
        );
    }
}