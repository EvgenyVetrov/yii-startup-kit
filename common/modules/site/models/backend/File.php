<?php

namespace modules\site\models\backend;

use modules\site\components\FileManager;
use yii\web\BadRequestHttpException;

/**
 * Class File
 * @package DeLuxis\Yii2SimpleFilemanager\models
 * @property string $mime
 * @property string $url
 * @property Directory $directory
 */
class File extends Item
{
    public function getUrl()
    {
        $fm = new FileManager();
        return \Yii::getAlias($fm->urlPath . $this->path);
    }

    public function getMime()
    {
        return mime_content_type($this->fullPath);
    }

    public function getIcon()
    {
        $icons = FileManager::$defaultIcons;

        if (isset($icons[$this->mime])) {
            return $icons[$this->mime];
        }

        if (isset($icons[$this->type])) {
            return $icons[$this->type];
        }
    }

    public function getDirectory()
    {
        return Directory::createByPath(dirname($this->path));
    }

    public function getSize()
    {
        return filesize($this->fullPath);
    }

    /**
     * @param string $path
     *
     * @return File
     * @throws BadRequestHttpException
     */
    public static function createByPath($path)
    {
        $file       = new File();
        $fm = new FileManager();
        $file->root = $fm->fullUploadPath;
        $file->path = $path;

        if ($file->type != 'file') {
            throw new BadRequestHttpException();
        }

        return $file;
    }
}