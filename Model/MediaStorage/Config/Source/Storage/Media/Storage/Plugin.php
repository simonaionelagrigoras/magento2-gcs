<?php
namespace cAc\Gcs\Model\MediaStorage\Config\Source\Storage\Media\Storage;

class Plugin
{
    public function afterToOptionArray($subject, $result)
    {
        $result[] = [
            'value' => \cAc\Gcs\Model\MediaStorage\File\Storage::STORAGE_MEDIA_GCS,
            'label' => __('Google Cloud Storage')
        ];
        return $result;
    }
}
