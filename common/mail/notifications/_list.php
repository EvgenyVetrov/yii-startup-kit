<?php
/**
 * Список закупок в уведомлении о новых найденных закупках
 * Created by PhpStorm.
 * User: vetrov
 * Date: 10.02.2020
 * Time: 9:40
 */

?>
    <hr>
<?php foreach ($notifications as $notifications): ?>
<p> <span class="text-bbb"> #<?= $notifications->tender->id ?> <?= $notifications->tender->category->getParentCategoryName() ?> </span> <?= $notifications->tender->category->name ?></p>
<p style="margin-bottom: 0; padding-bottom: 0;">
    <?= $notifications->tender->announce ?>
</p>

    <p style="text-align: right; padding-top: 0; margin-top: 0;">
        <a href="https://zakupator.org/tender/<?= $notifications->tender->id ?>"
           target="_blank" >Подробнее...</a>
    </p>
    <hr>
<?php endforeach; ?>
<br>
