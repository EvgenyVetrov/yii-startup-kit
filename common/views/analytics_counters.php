<?php

/* @var $this \yii\web\View */

/**
 * Массив выполненных целей
 */
$goals = [];

/**
 * Регистрация
 */
if (Yii::$app->session->getFlash('goal_registration')){
    $goals[] = 'yaCounter44070169.reachGoal("registration");';
}

/**
 * Активация аккаунта
 */
if (Yii::$app->session->getFlash('goal_activate_account')){
    $goals[] = 'yaCounter44070169.reachGoal("activate_account");';
}

/**
 * Пополнение баланса
 */
if (Yii::$app->session->getFlash('goal_pay_balance')){
    $goals[] = 'yaCounter44070169.reachGoal("pay_balance");';
}

/**
 * Если есть выполненные цели, отправляем их в метрику
 */
if (count($goals)){
    $goals = implode(PHP_EOL, $goals);
    $js =
        "
            /* Отправляем цель в Яндекс.Метрика */
            jQuery(document).on('yacounter44070169inited', function () {
                $goals
            });
        ";
    $this->registerJs($js);
}
?>

<!-- Yandex.Metrika counter -->
<script type="text/javascript" >
    (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
        m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
    (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

    ym(50838481, "init", {
        clickmap:true,
        trackLinks:true,
        accurateTrackBounce:true,
        webvisor:true
    });
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/50838481" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-127860622-1"></script>
<script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-127860622-1');
</script>

