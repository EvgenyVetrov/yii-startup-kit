<?php
/**
 * Created by PhpStorm.
 * User: vetrov
 * Date: 25.09.2019
 * Time: 1:19
 */

namespace modules\sitemap\models\backend;


use modules\main\models\backend\GeneralSettings;
use modules\sitemap\models\BaseSitemap;
use modules\tender\models\backend\Tenders;
use yii\web\View;
use Yii;

class Sitemap extends BaseSitemap
{
    public $frontSitemapFileName = 'front-sitemap.xml';
    public $tenderSitemapFileName = '-tender-sitemap.xml';
    public $indexSitemapFileName = 'sitemap.xml';


    /**
     * Генератор sitemap морды сайта.
     * Сайтмап морды записывается в отдельный файл
     */
    public function generateFrontSitemap()
    {
        $frontSitemapLocations = self::find()
            ->where(['status' => self::STATUS_ACTIVE])
            ->asArray()
            ->all();

        $view = new View();
        $generatedSitemap = $view->render('@modules/sitemap/views/backend/templates/_sitemap', [
            'locations' => $frontSitemapLocations
        ]);

        $result = file_put_contents($this->getSitemapPath('full').$this->frontSitemapFileName, $generatedSitemap);
        return $result;
    }


    /**
     * Генерация сайтмап файлов закупок
     */
    public function generateTendersSitemap()
    {
        $sitemapSize = \common\components\GeneralSettings::getSetting('sitemap-size');
        $sitemapSize = $sitemapSize ? $sitemapSize : 40000;

        // todo: возможно не самый лучший способ определения активных тендеров. Нужно единообразный метод где нибудь сделать
        $tendersQuery = Tenders::find()
            ->where(['status' => Tenders::STATUS_ACTIVE])
            ->andWhere(['<', 'date_start', time()])
            ->andWhere(['>', 'date_end', time()])
            ->andWhere(['private' => Tenders::PRIVATE_NO]);

        $activeTendersCount = $tendersQuery->count(); // сколько всего активных тендеров
        $paginationPages = ceil($activeTendersCount / $sitemapSize); // определяем количество файлов сайтмапа

        $page = 0;
        while ($page < $paginationPages) {
            $tendersSet = $tendersQuery->offset($page * $sitemapSize)
                ->limit($sitemapSize)
                ->asArray()
                ->all();

            $page++;
            $this->generateOneTenderSitemapFile($tendersSet, $page);
        }

    }



    /**
     * Очищаем директорию от сгенеренных сайтмапов чтоб потом туда добавить новые
     */
    public function clearSitemapsDirectory()
    {
        $files = glob($this->getSitemapPath('full') ."*.xml", GLOB_BRACE);
        foreach($files as $file) {
            unlink($file);
        }
    }



    /**
     * Генерация индексного сайтмапа:
     * считывание всех сайтмапов из директории и на этой основе генерируем новый
     */
    public function generateIndexSitemap()
    {
        $files = glob($this->getSitemapPath('full') ."*.xml", GLOB_BRACE);
        $newFiles = [];
        foreach($files as $file) {
            $newFiles[]['loc'] = Yii::$app->params['domain']
                . substr($this->getSitemapPath('web'), 1)
                . str_replace($this->getSitemapPath('full'), '', $file);
        }

        $view = new View();
        $generatedSitemap = $view->render('@modules/sitemap/views/backend/templates/_sitemapindex', [
            'sitemaps' => $newFiles
        ]);

        file_put_contents($this->getSitemapPath('full').$this->indexSitemapFileName, $generatedSitemap);
    }



    /**
     * Запись 1 файла сайтмапа для тендеров
     *
     * @param $tendersSet
     * @param $prefix
     * @return bool|int
     */
    private function generateOneTenderSitemapFile($tendersSet, $prefix)
    {
        $locations = [];
        foreach ($tendersSet as $tender) {
            $locations[] = [
                'loc'        => 'tender/' . $tender['id'],
                'priority'   => 5,
                'changefreq' => self::changefreqValues()[4], // еженедельно
                'lastmod'    => false
            ];
        }

        $view = new View();
        $generatedSitemap = $view->render('@modules/sitemap/views/backend/templates/_sitemap', [
            'locations' => $locations
        ]);

        $result = file_put_contents($this->getSitemapPath('full') . $prefix . $this->tenderSitemapFileName, $generatedSitemap);
        return $result;
    }

}






























