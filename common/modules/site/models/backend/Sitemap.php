<?php
/**
 * Created by PhpStorm.
 * User: evetrov
 * Date: 09.06.20
 * Time: 18:34
 */

namespace modules\site\models\backend;


use yii\web\View;

class Sitemap
{
    public $frontSitemapFileName = 'front-sitemap.xml';
    //public $tenderSitemapFileName = '-tender-sitemap.xml';
    public $indexSitemapFileName = 'sitemap.xml';

    /**
     * По сути библиоткеа для changefreq
     * @return array
     */
    public static function changefreqValues()
    {
        return [
            0 => 'не указано',
            1 => 'always',
            2 => 'hourly',
            3 => 'daily',
            4 => 'weekly',
            5 => 'monthly',
            6 => 'yearly',
            7 => 'never'
        ];
    }



    /**
     * По сути библиоткеа для changefreq
     * @return array
     */
    public static function priorityValues()
    {
        return [
            0 => '0.0',
            1 => '0.1',
            2 => '0.2',
            3 => '0.3',
            4 => '0.4',
            5 => '0.5',
            6 => '0.6',
            7 => '0.7',
            8 => '0.8',
            9 => '0.9',
            10 => '1.0'
        ];
    }



    /**
     * Возвращает путь до директории где хранятся файлы с сайтмапами
     *
     * @param string $mode
     * @return string
     */
    public static function getSitemapPath($mode = 'alias')
    {
        if ($mode == 'full') {
            return \Yii::getAlias('@files')  . '/sitemaps/';
        }
        if ($mode == 'alias') {
            return '@files/sitemaps/';
        }
        if ($mode == 'web') {
            return '/files/sitemaps/';
        }
    }




    /**
     * Генератор sitemap морды сайта.
     * Сайтмап морды записывается в отдельный файл
     */
    public function generateFrontSitemap()
    {
        $frontSitemapLocations = Pages::find()
            ->where(['status' => Pages::STATUS_ACTIVE])
            ->asArray()
            ->all();

        $view = new View();
        $generatedSitemap = $view->render('@modules/site/views/backend/sitemap/templates/_sitemap', [
            'locations' => $frontSitemapLocations
        ]);

        $result = file_put_contents($this->getSitemapPath('full').$this->frontSitemapFileName, $generatedSitemap);
        return $result;
    }



    /**
     * Очищаем директорию от сгенеренных сайтмапов чтоб потом туда добавить новые
     */
    public function clearSitemapsDirectory()
    {
        $files = glob(Sitemap::getSitemapPath('full') ."*.xml", GLOB_BRACE);
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

            $domain = \Yii::$app->params['domain'];
            // добавляем к домену слеш в конце если нет
            if (mb_substr($domain, -1) != '/') {
                $domain = $domain.'/';
            }

            $newFiles[]['loc'] = $domain
                . substr($this->getSitemapPath('web'), 1)
                . str_replace($this->getSitemapPath('full'), '', $file);
        }

        $view = new View();
        $generatedSitemap = $view->render('@modules/site/views/backend/sitemap/templates/_sitemapindex', [
            'sitemaps' => $newFiles
        ]);

        file_put_contents($this->getSitemapPath('full').$this->indexSitemapFileName, $generatedSitemap);
    }

}