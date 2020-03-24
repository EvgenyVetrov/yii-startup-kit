<?php
/**
 * Created by PhpStorm.
 * User: vetrov
 * Date: 25.09.2019
 * Time: 21:50
 *
 * @var $locations array
 */

$start = <<<HTML
<?xml version='1.0' encoding='UTF-8'?>
HTML;

$domain = Yii::$app->params['domain'];
?><?= $start ?>

<urlset xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
        xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd"
        xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <?php foreach ($locations as $location): ?>

    <url>
        <loc><?= $domain . $location['loc'] ?></loc>
        <?php if ($location['priority']): ?><priority><?= $location['priority']/10 ?></priority><?php endif; ?>
        <?php if ($location['changefreq']): ?><changefreq><?= $location['changefreq'] ?></changefreq><?php endif; ?>
        <?php if ($location['lastmod']): ?><lastmod><?= $location['lastmod'] ?></lastmod><?php endif; ?>

    </url>
    <?php endforeach; ?>

</urlset>