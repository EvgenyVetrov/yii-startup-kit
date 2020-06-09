<?php

namespace modules\site\components;



/**
 * Class FileManager
 * @property string $fullUploadPath
 */
class FileManager
{
    public $uploadPath = '@files';
    public $urlPath = '@filesUrl';

    public $icons = []; // @deprecated

    private $_uploadPath;

    public static $defaultIcons = [
        'dir'                => 'far fa-folder',
        'file'               => 'far fa-file',
        'image/gif'          => 'far fa-file-image',
        'image/tiff'         => 'far fa-file-image',
        'image/png'          => 'far fa-file-image',
        'image/jpeg'         => 'far fa-file-image',
        'application/pdf'    => 'far fa-file-pdf',
        'application/zip'    => 'far fa-file-archive',
        'application/x-gzip' => 'far fa-file-archive',
        'text/plain'         => 'far fa-file-text',
    ];

    public function init()
    {
        parent::init();

        $this->_checkPath();

        $this->icons = array_merge($this->defaultIcons, $this->icons);

        if ( ! isset(\Yii::$app->i18n->translations['filemanager'])) {
            \Yii::$app->i18n->translations['filemanager'] = [
                'class'          => 'yii\i18n\PhpMessageSource',
                'sourceLanguage' => 'en-US',
                'basePath'       => $this->basePath . '/messages',
                'fileMap'        => ['filemanager' => 'filemanager.php'],
            ];
        }
    }


    public function getFullUploadPath()
    {
        if ( ! isset($this->_uploadPath)) {
            $this->_uploadPath = \Yii::getAlias($this->uploadPath);
        }

        return $this->_uploadPath;
    }

    private function _checkPath()
    {
        if ( ! is_dir($this->fullUploadPath)) {
            mkdir($this->fullUploadPath, 0755, true);
        }
    }
}