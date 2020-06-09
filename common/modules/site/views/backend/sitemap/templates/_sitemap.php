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
    <?php foreach ($locations as $location):
        // немного говнокода. В целом это лучше перенести в модель или хелпер на крайняк
        if (mb_substr($domain, -1) == '/' AND mb_substr($location['location'], 0, 1) == '/') {
            $loc = $domain . mb_substr($location['location'], 1);
        } elseif (mb_substr($domain, -1) != '/' AND mb_substr($location['location'], 0, 1) != '/') {
            $loc = $domain . '/' . $location['location'];
        } else {
            $loc = $domain . $location['location'];
        }

        ?>

    <url>
        <loc><?= $loc ?></loc>
        <?php if ($location['sitemap_priority']): ?><priority><?= $location['sitemap_priority']/10 ?></priority><?php endif; ?>
        <?php if ($location['sitemap_changefreq']): ?><changefreq><?= \modules\site\models\backend\Sitemap::changefreqValues()[$location['sitemap_changefreq']] ?></changefreq><?php endif; ?>
        <?php
            $lastMod = $location['sitemap_lastmod'];
            if (!$lastMod AND $location['updated_at']) {
                $lastMod = date('d-m-Y', $location['updated_at']);
            }
            if ($lastMod):
                ?><lastmod><?= $lastMod ?></lastmod><?php endif; ?>

    </url>
    <?php endforeach; ?>

</urlset>