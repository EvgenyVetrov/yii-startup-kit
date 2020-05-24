<?php
/**
 * Флеши - всплывающие уведомления об успехе или ошибке при редиректах и подобном
 *
 * @var $this \yii\web\View
 */

$js = false;

if (Yii::$app->session->hasFlash('success')) {
    $title = Yii::t('app', 'TITLE_MODAL_SUCCESS');
    $text  = Yii::$app->session->getFlash('success');
    $js = <<<JS
     swal.fire('$title', '$text', 'success');
JS;


} elseif (Yii::$app->session->hasFlash('error')) {
    $title = Yii::t('app', 'TITLE_MODAL_ERROR');
    $text  = Yii::$app->session->getFlash('error');
    $js = <<<JS
     swal.fire('$title', '$text', 'error');
JS;

}elseif (Yii::$app->session->hasFlash('warning')) {
    $title = Yii::t('app', 'TITLE_MODAL_WARNING');
    $text  = Yii::$app->session->getFlash('warning');
    $js = <<<JS
     swal.fire('$title', '$text', 'warning');
JS;
} elseif (Yii::$app->session->hasFlash('info')) {
    $title = Yii::t('app', 'TITLE_MODAL_INFO');
    $text  = Yii::$app->session->getFlash('info');
    $js = <<<JS
     swal.fire('$title', '$text', 'info');
JS;
}

if ($js) {

    $this->registerJs($js);
}
?>
