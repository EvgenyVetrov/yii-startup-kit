<?php

namespace console\controllers;

use common\components\SendMail;
use modules\main\models\backend\Cities;
use modules\main\models\backend\Countries;
use modules\main\models\backend\Districts;
use yii;
use yii\console\Controller;

/**
 * Class MainController
 * @package console\controllers
 */
class MainController extends Controller {
    /**
     * Refresh schema cache
     */
    public function actionSchemaRefresh()
    {
        Yii::$app->db->schema->refresh();
        Yii::info('Refresh schema cache', 'app');
    }

    /**
     * Парсинг стран из json из ВК
     */
    public function actionParseVkCountries(){
        $data = file_get_contents(dirname(__DIR__) . '/data/countries.json');
        $data = json_decode($data, true);

        foreach ($data['response']['items'] as $item) {
            $model = new Countries();
            $model->id   = $item['id'];
            $model->name = $item['title'];
            $model->save(false);
            echo $item['title'] . PHP_EOL;
        }
    }


    public function actionParseVkRegions($region, $country_id){
        $data = file_get_contents(dirname(__DIR__) . '/data/regions_'. $region .'.json');
        $data = json_decode($data, true);

        foreach ($data['response']['items'] as $item) {
            $model = new Districts();
            $model->id         = $item['id'];
            $model->name       = $item['title'];
            $model->country_id =  $country_id;
            $model->status =  1;
            $model->save(false);
            echo $item['title'] . PHP_EOL;
        }
    }


    /**
     * Парсинг из временного файла городов по регионам.
     * @param $district_id - id региона согласно номенклатуре ВК
     * 1064424 - Орловская область
     * 1053480 - Московская область
     * 1045244 - ленинградская область
     */
    public function actionParseVkCities($district_id){
        $data = file_get_contents(dirname(__DIR__) . '/data/cities-tmp.json');
        $data = json_decode($data, true);

        foreach ($data['response']['items'] as $item) {
            if (isset($item['region'])){
                $model = new Cities();
                $model->id          = $item['id'];
                $model->district_id = $district_id;
                $model->name        = $item['title'];
                if (isset($item['area'])){
                    $model->area       = $item['area'];
                }
                $model->save(false);
                echo $item['title'] . PHP_EOL;
            }


        }
    }


    public function actionTestEmail()
    {
        $testHtml = <<<HTML
<html><head></head><body>
<div class="row" style="box-sizing: border-box; padding: 0; margin: 0 -10px 0 -10px; "><span style="box-sizing: border-box; display: table; "> </span>
    <div class="col-xs-12 col-md-12 col-lg-6 service-item" style="box-sizing: border-box; padding: 0 10px 0 10px; margin: 0; position: relative; min-height: 1px; width: 600px; float: none; ">
        <div class="service-panel mb-20" style="box-sizing: border-box; padding: 0; margin: 0; ">
            <div class="no-padding" style="box-sizing: border-box; padding: 0; margin: 0; ">
                <div class="service-widget panel-default panel mb-10" style="box-sizing: border-box; padding: 0; margin: 0 0 20px 0; background-color: #fff; border-radius: 3px; -webkit-box-shadow: 0 1px 1px rgba(0, 0, 0, 0.05); box-shadow: 0 1px 1px rgba(0, 0, 0, 0.05); border-color: #ddd; color: #333333; border: 1px solid #ddd; ">
                    <div class="panel-heading" style="box-sizing: border-box; margin: 0; padding: 15px 20px; border-bottom: 1px solid transparent; position: relative; border-top-right-radius: 3px; border-top-left-radius: 3px; border-color: #ddd; background-color:  #e42618; color:  #fff; ">
                        <div class="row" style="box-sizing: border-box; padding: 0; margin: 0 -10px 0 -10px; "><span style="box-sizing: border-box; display: table; "> </span>
                            <div class="col-xs-8" style="box-sizing: border-box; padding: 0 10px 0 10px; margin: 0; position: relative; min-height: 1px; width: 66.66666667%; float: left; ">
                                <h6 class="panel-title" style="box-sizing: border-box; padding: 0; margin: 0 0 0 0; font-family: inherit; font-weight: 400; line-height: 1.5384616; letter-spacing: -0.015em; color: inherit; position: relative; font-size: 15px; ">
                                    Train
                                </h6>
                            </div>
                            <div class="col-xs-4 text-right" style="box-sizing: border-box; padding: 0 10px 0 10px; margin: 0; text-align: right; position: relative; min-height: 1px; width: 33.33333333%; float: left; ">
    <img src="https://dev.bizontrip.com/img/carriers/railway/rzd_logo.png" alt="" height="23" style="box-sizing: border-box; padding: 0; margin: 0; border: 0; max-width: 100%; vertical-align: middle; height: 23px; ">
    <attachment style="display: none">eyJ1cmwiOiJodHRwczovL2Rldi5iaXpvbnRyaXAuY29tL2ltZy9jYXJyaWVycy9yYWlsd2F5L3J6ZF9sb2dvLnBuZyIsIm1hY3JvcyI6Int7NVFpWi11Rjh9fSJ9</attachment>
</div>
                        <span style="box-sizing: border-box; display: table; clear: both; "> </span></div>
                    </div>

                   <div class="info-direction p-10 row no-margin" style="box-sizing: border-box; margin: 0 0 0 0; border-top: none; padding: 10px 10px 10px 10px; background-color: white; "><span style="box-sizing: border-box; display: table; "> </span>
                        <div class="info-direction-date ml-10" style="box-sizing: border-box; padding: 0 0 0 10px; margin: 0; color: #999; ">
                            <span class="text-default" style="box-sizing: border-box; padding: 0; margin: 0; ">9 сентября, воскресенье</span>
                        </div>
                        <div class="info-direction-route col-xs-12" style="box-sizing: border-box; padding: 0 10px 0 10px; margin: 0; font-size: 17px; position: relative; min-height: 1px; width: 100%; float: left; ">
                            Москва → Санкт-Петербург
                        </div>
                        <div class="info-direction-time-block col-md-9 col-xs-12" style="box-sizing: border-box; padding: 0 10px 0 10px; margin: 0; position: relative; min-height: 1px; width: 100%; float: left; ">
                            <div class="info-direction-time" style="box-sizing: border-box; padding: 0; margin: 0; font-size: 16px; height: 23px; display: inline-block; vertical-align: baseline; ">
                                <span class="info-direction-time-start" style="box-sizing: border-box; padding: 0; margin: 0; ">
                                00:24
                                </span>
                                 –
                                <span class="info-direction-time-end" style="box-sizing: border-box; padding: 0; margin: 0; ">
                                   <span class="info-direction-time-end" style="box-sizing: border-box; padding: 0; margin: 0; ">
                                       08:07
                                   </span>
                                   <span class="next-date-indicator" style="box-sizing: border-box; padding: 0; margin: 0; color: #c55; font-size: 13px; font-style: italic; ">
                                     
                                     <span class="text-muted" style="box-sizing: border-box; padding: 0; margin: 0; color: #999999; "></span>
                                   </span>
                               </span>
                            </div>

                            <div class="info-direction-duration" style="box-sizing: border-box; padding: 0; margin: 0; font-size: 80%; color: rgba(100,100,100,.75); min-height: 17px; ">
                                В пути 7 h 43 min
                            </div>

                            <div class="text-muted" style="box-sizing: border-box; padding: 0; margin: 0; color: #999999; ">
                                <span class="train-number" style="box-sizing: border-box; padding: 0; margin: 0; ">Поезд № 056А, </span>
                                <span class="car-number" style="box-sizing: border-box; padding: 0; margin: 0; ">Вагон № 15, </span>
                                <span class="cartype-description" style="box-sizing: border-box; padding: 0; margin: 0; ">
                                    Место №38 (Плацкарт)
                                </span>
                            </div>
                        </div>
                    <span style="box-sizing: border-box; display: table; clear: both; "> </span></div>

                    <hr class="no-margin" style="box-sizing: content-box; display: block; height: 1px; border: 0; border-top: 1px solid #ededed; margin: 1em 0 1em 0; padding: 0; ">

                    <div class="pl-20 pr-20 pb-10 _trip-service-users" style="box-sizing: border-box; padding: 0 0 0 20px; margin: 0; ">
                        <div class="row mt-10" style="box-sizing: border-box; padding: 0; margin: 0 -10px 0 -10px; "><span style="box-sizing: border-box; display: table; "> </span>
                            <div class="col-xs-8 col-sm-8 mb-5" style="box-sizing: border-box; padding: 5px 10px 0 10px; margin: 0; position: relative; min-height: 1px; width: 66.66666667%; float: left; ">
                                <a class="text-default text-size-large dot mr-10" data-toggle="collapse" aria-expanded="true" style="box-sizing: border-box; padding: 0; margin: 0; background-color: transparent; color: #1E88E5; cursor: pointer; outline: 0; text-decoration: none; border-bottom: 1px dashed; font-size: 16px; ">
                                    Ветров Евгений
                                </a>
                                <span style="box-sizing: border-box; padding: 0; margin: 0; color: #FF7F17; ">•</span>&nbsp;
                                
                            </div>

                            <div class="col-xs-4 col-sm-4 text-right" style="box-sizing: border-box; padding: 5px 20px 0 10px; margin: 0; text-align: right; position: relative; min-height: 1px; width: 33.33333333%; float: left; ">
                                <div class="text-muted word-break" style="box-sizing: border-box; padding: 0; margin: 0; color: #999999; word-wrap: break-word; ">
                                    1&nbsp;498<sup>&nbsp;.60</sup>&nbsp;₽
                                </div>
                                
                            </div>

                            <div class="col-xs-12" style="box-sizing: border-box; padding: 0 10px 0 10px; margin: 0; position: relative; min-height: 1px; width: 100%; float: left; ">
                                <span class="text-muted mr-10 nowrap table-vertical-top" style="box-sizing: border-box; padding: 0; margin: 0; color: #999999; vertical-align: top; white-space: nowrap !important; ">Паспорт ****2123</span>
                                
                            </div>

                            <div class="col-xs-12 panel-collapse collapse in" aria-expanded="true" style="box-sizing: border-box; padding: 0 10px 0 10px; margin: 0; position: relative; min-height: 1px; width: 100%; float: left; display: block; ">
                                <div class="no-padding-top pb-5 break-word" style="box-sizing: border-box; padding: 0; margin: 0; word-wrap: break-word; ">
                                    <div class="row pt-10 pb-10 " style="box-sizing: border-box; padding: 0; margin: 0 -10px 0 -10px; "><span style="box-sizing: border-box; display: table; "> </span>
                                        <div class="col-xs-12" style="box-sizing: border-box; padding: 0 10px 0 10px; margin: 0; position: relative; min-height: 1px; width: 100%; float: left; ">
                                            <div style="box-sizing: border-box; padding: 0; margin: 0; ">
        <p class="text-size-large" style="box-sizing: border-box; padding: 0; margin: 0 0 10px; font-size: 14px; color: #FF7F17; ">Не соответствует тревел-политике</p>
    </div>

    <div style="box-sizing: border-box; padding: 0; margin: 0; "><a href="#" class="text-bold" style="box-sizing: border-box; padding: 0; margin: 0; background-color: transparent; cursor: pointer; outline: 0; text-decoration: none; font-weight: 700; color: #FF7F17; ">Rail Policy for Rita</a></div>
    <div class="bullet_block pr-20" style="box-sizing: border-box; padding: 0; margin: 0 0 0 15px; width: 100%; color: #FF7F17; "><span style="box-sizing: border-box; font-family: 'icomoon'; font-size: 16px; position: absolute; line-height: 21px; left: 10px; ">&gt;</span>ЖД станция отправления: Москва должно быть одно из Академическая, Буравщина</div>
<div class="bullet_block pr-20 sss" style="box-sizing: border-box; padding: 0; margin: 0 0 0 15px; width: 100%; display: none; "><span style="box-sizing: border-box; font-family: 'icomoon'; font-size: 16px; position: absolute; line-height: 21px; left: 10px; ">&gt;</span></div><div class="bullet_block pr-20" style="box-sizing: border-box; padding: 0; margin: 0 0 0 15px; width: 100%; color: #FF7F17; "><span style="box-sizing: border-box; font-family: 'icomoon'; font-size: 16px; position: absolute; line-height: 21px; left: 10px; ">&gt;</span>ЖД станция прибытия: Санкт-Петербург должно быть одно из Бараты, Заиграево</div>
<div class="bullet_block pr-20 sss" style="box-sizing: border-box; padding: 0; margin: 0 0 0 15px; width: 100%; display: none; "><span style="box-sizing: border-box; font-family: 'icomoon'; font-size: 16px; position: absolute; line-height: 21px; left: 10px; ">&gt;</span></div><div class="bullet_block pr-20" style="box-sizing: border-box; padding: 0; margin: 0 0 0 15px; width: 100%; color: #FF7F17; "><span style="box-sizing: border-box; font-family: 'icomoon'; font-size: 16px; position: absolute; line-height: 21px; left: 10px; ">&gt;</span>Класс вагона: Плацкарт должно быть СВ</div>
<div class="bullet_block pr-20 sss" style="box-sizing: border-box; padding: 0; margin: 0 0 0 15px; width: 100%; display: block; "><span style="box-sizing: border-box; font-family: 'icomoon'; font-size: 16px; position: absolute; line-height: 21px; left: 10px; ">&gt;</span>TTT: Класс поезда (xgh)</div><div class="bullet_block pr-20" style="box-sizing: border-box; padding: 0; margin: 0 0 0 15px; width: 100%; color: #FF7F17; "><span style="box-sizing: border-box; font-family: 'icomoon'; font-size: 16px; position: absolute; line-height: 21px; left: 10px; ">&gt;</span>Время отправления диапазон: 21:24 должно быть 00:00 - 10:00</div>
<div class="bullet_block pr-20 sss" style="box-sizing: border-box; padding: 0; margin: 0 0 0 15px; width: 100%; display: none; "><span style="box-sizing: border-box; font-family: 'icomoon'; font-size: 16px; position: absolute; line-height: 21px; left: 10px; ">&gt;</span></div><div class="bullet_block pr-20" style="box-sizing: border-box; padding: 0; margin: 0 0 0 15px; width: 100%; color: #FF7F17; "><span style="box-sizing: border-box; font-family: 'icomoon'; font-size: 16px; position: absolute; line-height: 21px; left: 10px; ">&gt;</span>Время прибытия диапазон: 05:07 должно быть 11:11 - 12:12</div>
<div class="bullet_block pr-20 sss" style="box-sizing: border-box; padding: 0; margin: 0 0 0 15px; width: 100%; display: none; "><span style="box-sizing: border-box; font-family: 'icomoon'; font-size: 16px; position: absolute; line-height: 21px; left: 10px; ">&gt;</span></div><div class="bullet_block pr-20" style="box-sizing: border-box; padding: 0; margin: 0 0 0 15px; width: 100%; color: #FF7F17; "><span style="box-sizing: border-box; font-family: 'icomoon'; font-size: 16px; position: absolute; line-height: 21px; left: 10px; ">&gt;</span>Стоимость: 1 498.60 RUB должно быть 2 222.00 RUB</div>
<div class="bullet_block pr-20 sss" style="box-sizing: border-box; padding: 0; margin: 0 0 0 15px; width: 100%; display: none; "><span style="box-sizing: border-box; font-family: 'icomoon'; font-size: 16px; position: absolute; line-height: 21px; left: 10px; ">&gt;</span></div>
                                        </div>
                                    <span style="box-sizing: border-box; display: table; clear: both; "> </span></div>

                                    <div style="box-sizing: border-box; padding: 10px 0 20px 0; margin: 0; ">
                                        <hr class="no-margin" style="box-sizing: content-box; display: block; height: 1px; border: 0; border-top: 1px solid #ededed; margin: 1em 0 1em 0; padding: 0; "><span class="label label-flat mr-5 mb-5" style="box-sizing: border-box; text-align: center; white-space: nowrap; vertical-align: baseline; display: inline-block; font-weight: 500; line-height: 1.5384616; text-transform: uppercase; font-size: 10px; letter-spacing: 0.1px; background-color: transparent; border-width: 2px; border-radius: 0; padding: 1px 4px 0 4px; border: 2px solid #4CAF50; color: #4CAF50; margin: 3px 5px 0 0; ">Бабистая Валентина</span>
                                    </div>
                                </div>
                            </div>
                        <span style="box-sizing: border-box; display: table; clear: both; "> </span></div>

                        <hr style="box-sizing: content-box; display: block; height: 1px; border: 0; border-top: 1px solid #ededed; margin: 1em 0 1em 0; padding: 0; ">
                        <span class="text-muted nowrap" style="box-sizing: border-box; padding: 0; margin: 0; color: #999999; white-space: nowrap !important; "></span>
                    </div>
                    <hr class="no-margin" style="box-sizing: content-box; display: block; height: 1px; border: 0; border-top: 1px solid #ededed; margin: 1em 0 1em 0; padding: 0; ">

                    <div class="panel-body panel-body-compact pr-20" style="box-sizing: border-box; margin: 0; position: relative; padding: 10px 10px 10px 20px; "><span style="box-sizing: border-box; display: table; "> </span>
                        <div class="row" style="box-sizing: border-box; padding: 0; margin: 0 -10px 0 -10px; "><span style="box-sizing: border-box; display: table; "> </span>
                            <div class="col-xs-10 col-sm-7" style="box-sizing: border-box; padding: 0 10px 0 10px; margin: 0; position: relative; min-height: 1px; width: 83.33333333%; float: left; ">
                                <span class="label heading-text" style="box-sizing: border-box; margin: 0; color: #fff; text-align: center; white-space: nowrap; vertical-align: baseline; display: inline-block; font-weight: 500; padding: 2px 5px 1px 5px; line-height: 1.5384616; border: 1px solid transparent; text-transform: uppercase; font-size: 10px; letter-spacing: 0.1px; border-radius: 2px; background-color: #0277BD; ">Оформлено</span>
                                
                            </div>
                        <span style="box-sizing: border-box; display: table; clear: both; "> </span></div>

                        <div class="row" style="box-sizing: border-box; padding: 0; margin: 0 -10px 0 -10px; "><span style="box-sizing: border-box; display: table; "> </span>
                            <div class="col-xs-12" style="box-sizing: border-box; padding: 5px 10px 0 10px; margin: 0; position: relative; min-height: 1px; width: 100%; float: left; ">
                                PNR: 117504387
                            </div>
                        <span style="box-sizing: border-box; display: table; clear: both; "> </span></div>
                    <span style="box-sizing: border-box; display: table; clear: both; "> </span></div>

                    <hr class="no-margin" style="box-sizing: content-box; display: block; height: 1px; border: 0; border-top: 1px solid #ededed; margin: 1em 0 1em 0; padding: 0; ">

                    <div class="panel-body panel-body-compact pr-20 pb-20" style="box-sizing: border-box; margin: 0; position: relative; padding: 10px 10px 10px 20px; "><span style="box-sizing: border-box; display: table; "> </span>
                        <div class="row" style="box-sizing: border-box; padding: 0; margin: 0 -10px 0 -10px; "><span style="box-sizing: border-box; display: table; "> </span>
                            <div style="box-sizing: border-box; padding: 0; margin: 0; ">
                                <div class="col-xs-12 col-sm-5 col-md-4 col-lg-3 pull-right trip-info-price pl-0" style="box-sizing: border-box; padding: 0 10px 0 10px; margin: 0; position: relative; min-height: 1px; width: 100%; text-align: right; float: right !important; ">
                                    <a class="price-details-link" href="#" style="box-sizing: border-box; padding: 0; margin: 0; background-color: transparent; cursor: pointer; outline: 0; text-decoration: none; border-bottom: 1px dashed  #607D8B; font-size: 18px; white-space: nowrap; color: #00527b !important; ">1&nbsp;498<sup>&nbsp;.60</sup>&nbsp;₽</a>
                                </div>
                            </div>
                        <span style="box-sizing: border-box; display: table; clear: both; "> </span></div>
                    <span style="box-sizing: border-box; display: table; clear: both; "> </span></div>
                </div>
            </div>
        </div>
    </div>
<span style="box-sizing: border-box; display: table; clear: both; "> </span></div>

</body></html>
HTML;



        return Yii::$app->mailer->compose()
            ->setFrom(Yii::$app->params['site_email'])
            ->setTo('post.vetrov@gmail.com')
            ->setSubject('test subject')
            ->setTextBody('test text body')
            ->setHtmlBody($testHtml)
            ->send();
    }


    /**
     * innoDB немного лучше имхо
     * провоторов настаиванет на Myisam, наверно стоит ему поверить ибо он дрочит на хайлоад
     * php yii main/generate-tenders-area 1000000
     * @param $num
     *
     *
     * SELECT * FROM myisam_area WHERE country_id = 2
     * AND (district_id = 2 OR district_id = 0)
     * AND (city_id = 22 OR city_id = 0)
     * AND NOT EXISTS(
     *   SELECT `id` FROM `myisam_except_area` WHERE
     *   `myisam_except_area`.`tender_id` = `myisam_area`.`tender_id`
     *   AND
     *   (
     *     (`myisam_except_area`.`country_id` = 2
     *     AND `myisam_except_area`.`district_id` = 2
     *     AND `myisam_except_area`.`city_id` = 22) OR
     *     ( `myisam_except_area`.`country_id` = 2
     *     AND `myisam_except_area`.`district_id` = 2
     *     AND `myisam_except_area`.`city_id` = 0) OR
     *     ( `myisam_except_area`.`country_id` = 2
     *     AND `myisam_except_area`.`district_id` = 0
     *     AND `myisam_except_area`.`city_id` = 0 )
     *   )
     * )
     * GROUP BY `myisam_area`.`tender_id`;
     */
    public function actionGenerateTendersArea($num){
        for ($i = 0; $i < $num; ++$i){
            $tender_id = rand (1, 100000);
            $country_id = rand (1, 5);
            $district_id = rand (0, 1000);
            $city_id = rand (0, 5000);

            $zero_city = rand (0, 5);
            $city_id = $zero_city ?  $city_id : 0;
            $zero_district = rand (0, 40);
            $district_id = $zero_district ? $district_id : 0;

            $sql = "INSERT INTO `myisam_area` (`tender_id`, `country_id`, `district_id`, `city_id`) VALUES ('$tender_id', '$country_id', '$district_id', '$city_id')";
            Yii::$app->db->createCommand($sql)->query();
        }
        echo PHP_EOL.'generated!'.PHP_EOL.PHP_EOL;
    }

    /**
     * php yii main/generate-tenders-except-area 1000000
     * @param $num
     */
    public function actionGenerateTendersExceptArea($num){
        for ($i = 0; $i < $num; ++$i){
            $tender_id = rand (1, 100000);
            $country_id = rand (1, 5);
            $district_id = rand (0, 1000);
            $city_id = rand (0, 5000);

            $zero_city = rand (0, 5);
            $city_id = $zero_city ?  $city_id : 0;
            $zero_district = rand (0, 40);
            $district_id = $zero_district ? $district_id : 0;

            $sql = "INSERT INTO `myisam_except_area` (`tender_id`, `country_id`, `district_id`, `city_id`) VALUES ('$tender_id', '$country_id', '$district_id', '$city_id')";
            Yii::$app->db->createCommand($sql)->query();
        }
        echo PHP_EOL.'generated!'.PHP_EOL.PHP_EOL;
    }
}