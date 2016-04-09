<?php
namespace Arkade\S3\Model\Cms\Wysiwyg\Images\Storage;

use Arkade\S3\Helper\Data;
use Magento\Cms\Model\Wysiwyg\Images\Storage;
use Magento\MediaStorage\Helper\File\Storage\Database;

class Plugin
{
    private $helper;
    private $database;

    public function __construct(Data $helper, Database $database)
    {
        $this->helper = $helper;
        $this->database = $database;
    }

    public function afterResizeFile(Storage $subject, $result)
    {
        if ($this->helper->checkS3Usage()) {
            $thumbnailRelativePath = $this->database->getMediaRelativePath($result);
            $this->database->getStorageDatabaseModel()->saveFile($thumbnailRelativePath);
        }
        return $result;
    }

    public function afterGetThumbsPath(Storage $subject, $result)
    {
        return rtrim($result, '/');
    }
}
