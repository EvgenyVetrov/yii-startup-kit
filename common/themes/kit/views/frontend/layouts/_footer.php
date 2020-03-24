<?php
/**
 * Вьюха подвала на морде сайта
 */
?>

<footer class="footer"  data-background-color="black">
    <div class="container">
        <nav class="float-left">
            <ul>
                <li>
                    <a href="/">
                        главная
                    </a>
                </li>
                <li>
                    <a href="/about">
                        о нас
                    </a>
                </li>
                <li>
                    <a href="/policy">
                        условия
                    </a>
                </li>
            </ul>
        </nav>
        <div class="copyright float-right">
            &copy;
            <script>
                document.write(new Date().getFullYear())
            </script> &nbsp; &nbsp; v<?= Yii::$app->params['frontend-version'] ?>
        </div>
    </div>
</footer>