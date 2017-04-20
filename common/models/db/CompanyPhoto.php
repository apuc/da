<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "company_photo".
 *
 * @property integer $id
 * @property integer $company_id
 * @property string $photo
 */
class CompanyPhoto extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'company_photo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['company_id', 'photo'], 'required'],
            [['company_id'], 'integer'],
            [['photo'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'company_id' => 'Company ID',
            'photo' => 'Photo',
        ];
    }

    public static function savePhotos($companyId, $photos)
    {
        if(!empty($companyId && !empty($photos))){
            $photosArr = explode(',', $photos);
            static::deleteAll(['company_id' => $companyId]);
            foreach ($photosArr as $photo){
                $ph = new static();
                $ph->company_id = $companyId;
                $ph->photo = $photo;
                $ph->save();
            }
            return true;
        }
        return false;
    }
}
