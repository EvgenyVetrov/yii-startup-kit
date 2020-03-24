<?php
/**
 * Created by PhpStorm.
 * User: vetrov
 * Date: 03.04.2019
 * Time: 12:10
 */

namespace modules\blog\models\frontend;

use modules\blog\models\BaseBlogPosts;

class BlogPosts extends BaseBlogPosts
{

    /**
     * Вспомогательная функция для получения правильного URL главной картинки
     * @return string
     */
    public function getGeneralImageUrl()
    {
        if ($this->general_image){
            return '/img/blog/posts/'. $this->id . '/' . $this->general_image;
        }

        return '/img/blog/default/general/1.jpg';
    }



    /**
     * Проверка можно ли показывать пост или нет
     * Проверка на существование поста уже проведена. Пост существует.
     * @return bool
     */
    public function canViewPost()
    {
        if ($this->status == self::STATUS_DRAFT OR
            $this->publication_date < time()) {
            return true;
        }

        return false;
    }

}