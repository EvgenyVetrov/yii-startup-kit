<?php namespace modules\main\components;
/**
 * Общие методы для всего
 *
 * некая свалка методов, которые некуда приткнуть
 */

class Common
{

    /**
     * Единый метод получения всевозможных лаодеров
     * использовать в тексте только двойные кавычки ибо на клиенте это дело может быть обернуто в одинарные
     *
     * @param bool $type
     * @return string
     */
    public static function getLoader($type = false)
    {
        switch ($type) {


            /*
             * <div class="loader10 loader">
    <svg width="38px" height="8px" viewBox="0 0 38 8" fill="#4FB95C">
        <circle cx="4" cy="4" r="4" />
        <circle cx="19" cy="4" r="4" />
        <circle cx="34" cy="4" r="4" />
    </svg>
</div>
             * */
            case ('line-dots'):
                return <<<HTML
<div class="loader10 loader">
    <svg width="38px" height="8px" viewBox="0 0 38 8" fill="#4FB95C">
        <circle cx="4" cy="4" r="4" />
        <circle cx="19" cy="4" r="4" />
        <circle cx="34" cy="4" r="4" />
    </svg>
</div>
HTML;

                break;
            default:
                return <<<HTML
<div class="loader10 loader">
<div class="width-40 inline-block">
    <svg viewBox="0 0 38 8"  fill="#CCC" >
        <circle cx="4" cy="4" r="4" />
        <circle cx="19" cy="4" r="4" />
        <circle cx="34" cy="4" r="4" />
    </svg>
</div>
    
</div>
HTML;
        }
    }


    /**
     * Проверка на URL
     *
     * @param $url
     * @return false|int
     */
    public static function isUrl($url) {
        return preg_match('|^http(s)?://[a-z0-9-]+(.[a-z0-9-]+)*(:[0-9]+)?(/.*)?$|i', $url);
    }

}