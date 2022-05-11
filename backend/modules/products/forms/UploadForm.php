<?php

namespace backend\modules\products\forms;

use yii\base\Model;
use yii\web\UploadedFile;

class UploadForm extends Model
{
    /**
     * @var UploadedFile
     */
    public $imageFile;

    public function rules()
    {
        return [
            [
                [
                    'imageFile'
                ],
                'file',
                'skipOnEmpty' => false,
                'extensions' => 'xls, xlsx',
                'maxSize' => 1024 * 1024 * 30, // 30МБ

            ],
        ];
    }

    public function upload()
    {
        if ($this->validate()) {
            $this->imageFile->saveAs('uploads/' . $this->imageFile->baseName . '.' . $this->imageFile->extension);
            return true;
        } else {
            return false;
        }
    }
}