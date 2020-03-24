<?php

namespace common\components;
use yii\helpers\HtmlPurifier;

/**
 * Class Formatter
 * @package common\components
 */
class Formatter extends \yii\i18n\Formatter {

    /**
     * Возвращает таймштамп из даты
     * @param $date string - дата в любом формате
     * @param $format string - описание формата
     * @return int|false - таймштамп
     */
    public static function asDateToTimestamp($date, $format)
    {
        $time = \DateTime::createFromFormat($format, $date);

        if ($time){
            $time = $time->setTime(0, 0, 0);
            return $time->getTimestamp();
        }else{
            return false;
        }
    }



    /**
     * @param $dateTime
     * @param $format
     * @return bool|int
     */
    public function asDateTimeToTimestamp($dateTime, $format)
    {
        $time = \DateTime::createFromFormat($format, $dateTime);

        return $time ? $time->getTimestamp() : false;
    }



    /**
     * преобразует 2 таймштампа в диапазон дат на русском языке
     *
     * @param int $timestamp_start
     * @param int $timestamp_end
     * @return string
     */
    public function dateRangeText(int $timestamp_start, int $timestamp_end)
    {
        $date_start  = (new \DateTime)->setTimestamp($timestamp_start);
        $month_arr_ru = [
            1 => 'января',
            2 => 'февраля',
            3 => 'марта',
            4 => 'апреля',
            5 => 'мая',
            6 => 'июня',
            7 => 'июля',
            8 => 'августа',
            9 => 'сентября',
            10 => 'октября',
            11 => 'ноября',
            12 => 'декабря',
        ];
        $year_start  = $date_start->format('Y');
        $month_start_num = $date_start->format('n');
        $month_start = $month_arr_ru[$month_start_num];
        $day_start   = $date_start->format('j');

        $date_end  = (new \DateTime)->setTimestamp($timestamp_end);
        $year_end  = $date_end->format('Y');
        $month_end_num = $date_end->format('n');
        $month_end = $month_arr_ru[$month_end_num];
        $day_end   = $date_end->format('j');

        if ($year_start == $year_end AND $month_start_num == $month_end_num) {
            return $day_start . ' - ' . $day_end . ' ' . $month_start . ' ' . $year_start;
        }

        if ($year_start == $year_end ) {
            return $day_start . ' ' . $month_start . ' - ' . $day_end . ' ' . $month_end . ' ' . $year_start;
        }
        return $day_start . ' ' . $month_start . ' ' . $year_start . ' - ' . $day_end . ' ' . $month_end . ' ' . $year_end;
    }



    /**
     * Превращает разницу диапазонов дат в текстовое описание остатка времени
     *
     * @param int $old_timestamp
     * @param int $new_timestamp
     * @param array $params - $params['short_back'] = true =>> вместо "назад" будет подстваляться минус вначале
     * @return string
     */
    public function dateDiffText(int $old_timestamp, int $new_timestamp, $params = [])
    {
        $back = '';
        $prefix = '';
        $diffMinutes = abs($new_timestamp - $old_timestamp) / 60;
        if ($old_timestamp > $new_timestamp) {
            $back = ' назад';
        }
        if ($params['short_back'] AND $old_timestamp > $new_timestamp) {
            $back = '';
            $prefix = '-';
        }

        if ($diffMinutes < 60 and $back) { return 'менее часа' . $back; }
        if ($diffMinutes < 60 and $prefix) { return $prefix . ceil($diffMinutes). ' мин.'; }

        if ($diffMinutes < (60 * 24)) {
            $num = ceil($diffMinutes / 60);
            return  $prefix . $num . ' ' . $this->pluralForm($num, 'час', 'часа', 'часов') . $back;
        }

        $num = ceil($diffMinutes / (60*24));
        return  $prefix . $num . ' ' . $this->pluralForm($num, 'день', 'дня', 'дней') . $back;
    }



    /**
     * Склонение существительных с числительными.
     * Функция принимает число $n и три строки - разные формы произношения измерения величины.
     * Необходимая величина будет возвращена.
     * Например: pluralForm(100, "рубль", "рубля", "рублей") вернёт "рублей".
     *
     * @param int величина
     * @param string форма1 - день
     * @param string форма2 - дня
     * @param string форма3 - дней
     * @return string
     */
    public function pluralForm($n, $form1, $form2, $form3)
    {
        $n = abs($n) % 100;
        $n1 = $n % 10;

        if ($n > 10 && $n < 20) { return $form3; }
        if ($n1 > 1 && $n1 < 5) { return $form2; }
        if ($n1 == 1) { return $form1; }
        return $form3;
    }



    /**
     * Преобразование ID чего угодно в путь, разбитый на папки по 100 объектов + 100 папок
     * Пример:  id 123456789 ==>> 1/23/45/67
     *          id 1     ==>> 0
     *          id 89    ==>> 0
     *          id 100   ==>> 1
     *          id 159   ==>> 1
     *          id 200   ==>> 2
     *          id 2359  ==>> 23
     *          id 23789 ==>> 2/37
     * @param $id
     * @return string
     */
    public function idToPath($id)
    {
        $string = strrev(floor($id/100));
        $chunks = str_split($string, 2);
        $string = implode('/', $chunks);
        return strrev($string);
    }



    /**
     * Создает уникальное название на основе ID
     * таймштамп в 32-ричной системе конкантенирует с ID в 32 ричной системе
     * Нужно, что бы нельзя было вычислить URL картинки к которой не должно быть доступа.
     * @param $id
     * @return string
     */
    public function nameFromId($id)
    {
        $time32 = base_convert(time(true), 10, 32);
        $id32   = base_convert($id, 10, 32);
        return $time32 . $id32;
    }



    /**
     * Метод для очистки пользовательских данных перед записью в БД.
     * Использовать по коду вот так: Yii::$app->formatter->clearData($data)
     * можно добавлять режимы и аргументы, что бы фильтровать по определенным регуляркам и тп
     *
     * @param $data
     * @param string $mode
     * @return string
     */
    public function clearData($data, $mode = 'default')
    {
        $data = trim($data);

        switch ($mode):
            case ('default'):
                return strip_tags($data);
                break;
            case ('json'): // не то что бы пытается вытащить правильный json, просто возвращает исходный json, если все ок, или json  сошибкой если не ок
                json_decode($data);
                if (json_last_error() == JSON_ERROR_NONE) {
                    return $data;
                } else {
                    return '{error:"'. json_last_error() .'"}';
                }
                break;
            case ('htmlspecialchars'):
                return htmlspecialchars($data);
            case ('simple_string'): // простая строка например для имени. Без html тегов
                $data = trim($data);
                $data = strip_tags($data);
                return $data;
            case ('simple_html'): // html с базовыми тегами
                $data = trim($data);
                $data = HtmlPurifier::process($data, ['HTML.Allowed' => 'a[href|target],br,strong,p,img[src],p,b,ul,li,sub,sup']);
                return $data;
        endswitch;
    }



    /**
     * Возвращает отформатированный диапазон чисел
     *
     * @param int $from
     * @param int $to
     * @param string $noOneText
     * @return string
     */
    public function numbersRange(int $from = 0, int $to = 0, $noOneText = 'не указано', $finish_text = '')
    {
        if ($from AND $to){
            return 'от '
                . number_format($from, 0, '.', '&nbsp;')
                . ' до '
                . number_format($to, 0, '.', '&nbsp')
                . $finish_text;
        }
        if ($from AND !$to){
            return 'от '
                . number_format($from, 0, '.', '&nbsp;')
                . $finish_text;
        }
        if (!$from AND $to){
            return 'до '
                . number_format($to, 0, '.', '&nbsp;')
                . $finish_text;
        }
        if (!$from AND !$to){
            return $noOneText;
        }
    }

}