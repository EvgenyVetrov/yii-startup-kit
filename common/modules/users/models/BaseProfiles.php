<?php

namespace modules\users\models;

use modules\organisations\models\frontend\Organisations;
use modules\users\models\frontend\Profiles;
use Yii;
use yii\web\NotFoundHttpException;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "profiles".
 *
 * @property int $id
 * @property int $user_id            - связь с юзером. У юзера может быть много профилей (по количеству организаций)
 * @property int $org_id             - связь с организацией. 1 профиль к 1 организации
 * @property array $json_contacts    - некий кеш контактов из таблицы contacts
 * @property string $custom_contacts - произвольный текст с контактами
 * @property int $role               - роль относительно организации
 * @property string $position
 * @property int $invite_status
 * @property int $invite_date        - изначально задумывалось как дата приглашения, но дата создания и есть дата приглашения, поэтому будет дата подтверждения
 * @property int $invite_user
 * @property int $status
 * @property string $own_description
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Organisations $orgModel
 */
class BaseProfiles extends \yii\db\ActiveRecord
{
    const ROLE_UNDEFINED = 0; // роль не определена. Такого по идее не должно быть, но мало ли
    const ROLE_OWNER     = 1;   // владелец организации. Возможно основной акционер. Владельцев может быть несколько, а может и ни одного. Может делать все, в тч добавлять удалять других владельцев и мнеджеров
    const ROLE_MANAGER   = 2; // по правам - тоже самое что и владелец, только не может удалять/добавлять владельцев
    const ROLE_REDACTOR  = 3; // может редактировать информацию об организации, составлять отклики и т.д.
    const ROLE_OPERATOR  = 4; // может составлять закупки и откликаться на них. Низшая роль

    const INVITE_NOT_CONFIRMED = 0;
    const INVITE_CONFIRMED     = 1;
    const INVITE_REJECTED      = 2;

    const SCENARIO_CREATE      = 1; // простое создание с минимальными данными
    const SCENARIO_EDIT        = 2; // простое редактирование без редактирования роли
    const SCENARIO_EDIT_ROLE   = 3; // тут уже возможность изменить роль добавляется


    public $orgModel  = null;
    public $userModel = null;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'profiles';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'org_id', 'invite_date', 'invite_user', 'invite_status', 'created_at', 'updated_at'], 'integer', 'message' => 'Должно быть число'],
            [['user_id', 'org_id', ], 'required', 'message' => 'Заполните поле'],
            [['json_contacts'], 'string'],
            [['custom_contacts'], 'string', 'max' => 1000],
            [['role', 'status'], 'integer', 'max' => 100],
            [['position'], 'string', 'max' => 120],
            [['own_description'], 'string', 'max' => 700],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'            => 'ID',
            'user_id'       => 'User ID',
            'org_id'        => 'Org ID',
            'json_contacts' => 'Json Contacts',
            'custom_contacts' => 'Контакты',
            'role'          => 'Роль',
            'position'      => 'Должность',
            'invite_status' => 'Invite Status',
            'invite_date'   => 'Invite Date',
            'invite_user'   => 'Invite User',
            'status'        => 'Статус',

            'own_description' => 'Own Description',
            'created_at' => 'Создано',
            'updated_at' => 'Обновлено',
        ];
    }


    public function behaviors()
    {
        return [
            TimestampBehavior::class,
        ];
    }



    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios[self::SCENARIO_CREATE]    = ['user_id', 'org_id', 'role', 'invite_user'];
        $scenarios[self::SCENARIO_EDIT]      = ['custom_contacts', 'position', 'status'];
        $scenarios[self::SCENARIO_EDIT_ROLE] = ['custom_contacts', 'position', 'role', 'status'];
        return $scenarios;
    }



    /**
     * Список лейблов ролей
     *
     * @param bool $availableRoles - отфильтровать только доступные роли
     * @param array $exceptRoles   - перечисление ролей, которые нужно исключить из списка
     * @return array
     */
    public function rolesLabels($availableRoles = false, $exceptRoles = [])
    {
        $roles = [
            self::ROLE_UNDEFINED => 'Не определена',
            self::ROLE_OWNER     => 'Владелец',
            self::ROLE_MANAGER   => 'Управляющий',
            self::ROLE_REDACTOR  => 'Редактор',
            self::ROLE_OPERATOR  => 'Оператор'
        ];

        if ($availableRoles) {
            $hasOrgManager = self::find()->where(['org_id' => $this->org_id, 'role' => [self::ROLE_OWNER, self::ROLE_MANAGER]])->exists();
            if (!$hasOrgManager AND $this->orgModel->author_id == $this->user_id) {
                $roles = [
                    self::ROLE_OWNER     => 'Владелец',
                    self::ROLE_MANAGER   => 'Управляющий',
                ];
            } else {
                unset($roles[self::ROLE_UNDEFINED]);
            }
        }

        // если перечислены исключенные роли, то удаляем их из списка ролей
        foreach ($exceptRoles as $exceptRole) {
            unset($roles[$exceptRole]);
        }

        return $roles;
    }



    public function getInviteStatusLabel()
    {
        switch ($this->invite_status) {
            case 0:
                return 'не подтверждено';
                break;
            case 1:
                return 'подтверждено';
                break;
            case 2:
                return 'отклонено';
        }
    }


    /**
     * Связь с таблицей юзеров
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(BaseUsers::class, ['id' => 'user_id']);
    }



    /**
     * Поиск модели и обработка эксцепшенов
     * чтоб каждый раз не писать в контроллерах этот метод
     *
     * @param $profile_id
     * @return null|static
     * @throws NotFoundHttpException
     */
    public static function findModel($profile_id)
    {
        if (($model = self::findOne($profile_id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('Профиля #'. $profile_id .' не существует');
        }
    }
}