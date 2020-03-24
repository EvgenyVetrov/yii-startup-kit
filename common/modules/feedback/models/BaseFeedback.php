<?php

namespace modules\feedback\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "feedback".
 *
 * @property int $id
 * @property int $user_id
 * @property string $email
 * @property int $org_id
 * @property int $type
 * @property int $object - по идее должна быть принадлежность к объекту, что-то вроде названия класса или подобное
 * @property int $object_id - id объекта, ну наример если объект - тендер, то object_id - это id тендера на которой составлен фидбэк
 * @property string $text
 * @property string $ip
 * @property string $user_agent
 * @property string $device_info
 * @property string $own_description
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 * @property array $formedTypeList
 */
class BaseFeedback extends \yii\db\ActiveRecord
{
    const TYPE_OTHER       = 0; // прочее обращение
    const TYPE_COMPLAINT   = 1; // жалоба, просто обобщенная жалоба
    const TYPE_SPAM        = 2; // нежелательная реклама
    const TYPE_FRAUD       = 3; // мошенничество
    const TYPE_INSULT      = 4; // оскорбление
    const TYPE_VIOLATION   = 5; // нарушение правил
    const TYPE_ERROR       = 6; // Ошибка на сайте, БАГ
    const TYPE_IMPROVEMENT = 7; // предложение улучшения, развития, идеи
    const TYPE_HELP        = 8; // предложение помощи
    const TYPE_COOPERATION = 9; // предложение сотрудничества
    const TYPE_THANKS      = 10; // благодарность, хороший отзыв

    const STATUS_NEW      = 0; // новое обращение
    const STATUS_READ     = 1; // прочтено
    const STATUS_ANSWERED = 2; // отвечено

    const SCENARIO_FRONT = 'front'; // сценарий получения фидбека с морды сайта без json обмена
    const SCENARIO_JSON  = 'json';
    const SCENARIO_READ  = 'read';

    const TYPE_LABELS = [
        0  => 'Прочее обращение',
        1  => 'Другая жалоба',
        2  => 'Спам, нежелательная реклама',
        3  => 'Мошенничество',
        4  => 'Оскорбления, угрозы',
        5  => 'Нарушение правил',
        6  => 'Ошибка на сайте',
        self::TYPE_IMPROVEMENT => 'Предложение улучшения, развития',
        8  => 'Предложение помощи',
        9  => 'Предложение сотрудничества',
        10 => 'Благодарность',
    ];

    /* объекты оратной связи (тендер, отклик и тд).
    По сути 1 объект - это 1 таблица в бд. Но могут быть объекты без привязки к таблице в бд.
    Содержимое этого массива менять нельзя, можно только дополнять */
    const OBJECT_TYPES = [
        0 => [
            'name' => 'Объект не определен',
        ],
        1 => [
            'name'  => 'Закупка',
            'class' => 'modules\\tender\\models\\frontend\\Tenders'
        ],
        2 => [
            'name' => 'Отклик', // предложение
            'class' => 'modules\\offers\\models\\frontend\\Offers'
        ],
        3 => [
            'name' => 'Комментарий'
        ],
        4 => [
            'name' => 'Отклонение'
        ],
        5 => [
            'name' => 'Избранное'
        ],
        6 => [
            'name' => 'Пользователь'
        ],
        7 => [
            'name' => 'Организация'
        ],

        10 => [
            'name' => 'Общий отзыв'
        ],
    ];

    const STATUS_LABELS = [
        0  => 'Новое',
        1  => 'Прочтено',
        2  => 'Отвечено',
    ];



    /**
     * сформированный список типов обращений из formTypeList()
     * @var array
     */
    public $formedTypeList = [];

    public $reCaptcha;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'feedback';
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::class,
        ];
    }


    public function scenarios()
    {
        return [
            // сценарий для сохранения обратной связи со страницы "о нас" /about
            self::SCENARIO_FRONT => ['user_id', 'org_id', 'type', 'object', 'object_id', 'status', 'device_info', 'ip', 'email', 'text', 'user_agent', 'reCaptcha'],
            // стандартный сценарий сохранения отзыва через модальное окно
            self::SCENARIO_JSON => ['user_id', 'org_id', 'type', 'object', 'object_id', 'status', 'device_info', 'ip', 'email', 'text', 'user_agent'],
            self::SCENARIO_READ => ['updated_at', 'status'],
        ];
    }

    /**
     * @inheritdoc
     *
     * todo: сделать фильры данных
     */
    public function rules()
    {
        return [
            [['device_info'], 'filter', 'filter' => function($value) {
                return Yii::$app->formatter->clearData($value, 'json');
            }],

            [['text'], 'filter', 'filter' => function($value) {
                return Yii::$app->formatter->clearData($value, 'simple_string');
            }],

            [['user_id', 'org_id', 'type', 'object', 'object_id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['device_info'], 'string'],
            [['ip'], 'string', 'max' => 54],
            [['email'], 'email'],
            [['text', 'own_description'], 'string', 'max' => 1000],
            [['user_agent'], 'string', 'max' => 500],
            [
                ['reCaptcha'],
                \himiklab\yii2\recaptcha\ReCaptchaValidator::class,
                'secret' => Yii::$app->params['recaptcha']['secret_key'],
                'uncheckedMessage' => 'Please confirm that you are not a bot.',
                //'skipOnEmpty' => true
            ]

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
            'email'         => 'Email',
            'org_id'        => 'Org ID',
            'type'          => 'Type',
            'object'        => 'Object',
            'object_id'     => 'Object ID',
            'text'          => 'Текст сообщения',
            'ip'            => 'IP',
            'user_agent'    => 'User Agent',
            'device_info'   => 'Device Info',
            'own_description' => 'Внутренее примечание',
            'status'        => 'Статус',
            'created_at'    => 'Создано',
            'updated_at'    => 'Обновлено',
        ];
    }



    /**
     * Лейблы для типов
     * @return array
     */
    public function typeLabels()
    {
        return self::TYPE_LABELS;
    }



    /**
     * Лейблы для статусов. В основном уже
     * @return array
     */
    public function statusLabels()
    {
        return self::STATUS_LABELS;
    }



    /**
     * Формирование списка типов для фидбеков
     *
     * @param array $list - принимает массив [1, 6, 0, 10] - что бы расставить в нужном порядке лейблы
     * @return array [1 => 'Жалоба', 6 => 'Ошибка на сайте'...]
     */
    public function formTypeList(array $list)
    {
        $resultList = [];
        foreach ($list as $id) {
            $resultList[$id] = self::TYPE_LABELS[$id];
        }

        $this->formedTypeList = $resultList; // и в свойство записываем
        return $resultList; // и возвращаем
    }

    /**
     * Тоже самое, что и formTypeList(), только статический метод, чтоб экономней по ресурсам
     * @param array $list
     * @return array
     */
    public static function formTypeListLight(array $list, $asJson = false)
    {
        $resultList = [];
        foreach ($list as $id) {
            $resultList[$id] = self::TYPE_LABELS[$id];
        }

        if ($asJson) { return json_encode($resultList); }
        return $resultList; // и возвращаем
    }

}
