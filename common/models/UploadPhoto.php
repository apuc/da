<?php

namespace common\models;

use common\classes\Debug;
use yii\base\Model;
use yii\web\UploadedFile;

class UploadPhoto extends Model
{
    /**
     * @var UploadedFile
     */
    public $imageFile;
    public $location;

    public function rules()
    {
        return [
            [['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg'],
        ];
    }

    public function upload()
    {
        if ($this->validate()) {

            $this->imageFile->saveAs($this->location . $this->imageFile->baseName . '.' . $this->imageFile->extension);
            return true;
        } else {
            return false;
        }
    }

    /**
     *
     * @param $image
     * @return string image
     */
    public static function getImageOrNoImage($image)
    {

        if (!empty($image) && file_exists($_SERVER['DOCUMENT_ROOT'] . '/frontend/web' . trim($image))) {
            return $image;
        }

        return '/theme/portal-donbassa/img/no-image.png';
    }

}