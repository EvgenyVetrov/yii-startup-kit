<?php

use yii\helpers\Url;
use yii\helpers\Html;
use modules\users\Module;

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

$this->title = $name;
$assetPath = Yii::$app->assetManager->getPublishedUrl(Yii::$app->params['assetPath']);
Yii::$app->params['robots'] = 'none'; // на всякий случай
?>

<div class="row site-error">
    <div class="col-md-10 col-lg-8 col-lg-offset-2 col-md-offset-1">
        <div class="card card-signup">
            <h2 class="card-title text-center"><?= Html::encode($this->title) ?></h2>
            <div class="alert alert-danger text-center">
                <?= nl2br($message) ?>
            </div>
            <div class="card-body">
                    <div class="col-md-12 mt-20 pr-lg-30 pl-lg-30">
                        <p>Иногда бывает, что что-то идет не так. Мы уже думаем как решить эту проблему. Вы можете нам помочь, отправив описание действий, которые привели к такому случаю
                            <strong><a href="/about">тут</a></strong>.
                        </p>
                    </div>
            </div>
        </div>
    </div>
</div>