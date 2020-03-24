<?php
/**
 * Created by PhpStorm.
 * User: vetrov
 * Date: 08.01.2020
 * Time: 22:56
 */

namespace console\controllers;


use yii\console\Controller;
use modules\tender\models\BaseTenderSubscriptionsFinderLog;
use modules\tender\models\BaseTenderSubscriptionsNotifications;

/**
 * Консольный контроллер для кроновских задач, связанных
 *
 * Class TenderController
 * @package console\controllers
 */
class TenderController extends Controller
{

    /**
     * Обход на поиск новых закупок и рассылка нотификаций
     */
    public function actionRunTendersFinder()
    {
        BaseTenderSubscriptionsFinderLog::findNewTenders();
        // а почему бы сразу после поиска не пройтись ноификационным скриптом:
        BaseTenderSubscriptionsNotifications::notifySubscriptions();
    }
}