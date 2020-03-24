<?php
/**
 * Контроллер для методов и страничек которые больше некуда приткнуть.
 * Если тут набирается большая группа методов, которую можно обобщить (например tools), то стоит отрефакторить и выделить в отдельный контроллер
 */

namespace modules\main\controllers\backend;


use yii\web\Controller;

class MainController extends Controller
{
    public function actionPhpinfo()
    {
        return $this->render('phpinfo');
    }

    public function actionPhpinfoEmpty() {
        return $this->renderPartial('phpinfo_empty');
    }

}