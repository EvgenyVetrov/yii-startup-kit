<?php
/**
 * Created by PhpStorm.
 * User: vetrov
 * Date: 25.09.2019
 * Time: 21:50
 *
 * @var $sitemaps array
 */

$start = <<<HTML
<?xml version='1.0' encoding='UTF-8'?>
HTML;

$domain = Yii::$app->params['domain'];

?><?= $start ?>

<sitemapindex xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
              xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/siteindex.xsd"
              xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">

    <?php foreach ($sitemaps as $sitemap): ?>
    <sitemap><loc><?= $sitemap['loc'] ?></loc></sitemap>
    <?php endforeach; ?>

</sitemapindex>
