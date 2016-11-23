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
}