<?php

use Yii;

/**
 * Вьюха для отображения аватарки или заглушки пользователя в профиле юзера.
 * Берется при изначальном рендринге и по ajax
 *
 * @var $model \modules\users\models\frontend\Users
 */


?>


<?php if ($model->avatar): ?>
    <img src="/files/users/avatars/<?= Yii::$app->formatter->idToPath($model->id) ?>/ava-<?= $model->avatar ?>" alt="">
<?php else: ?>
    <div class="svg-container-200 svg-999">
        <?= $model->getBlankAvatar(); ?>
    </div>
<?php endif; ?>
<?php /*$form->field($model, 'avatar')->widget(Widget::className(), [
'config' => [
    'aspectRatio' => 1
]
])*/ ?>
