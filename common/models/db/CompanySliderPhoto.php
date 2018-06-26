<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "company_slider_photo".
 *
 * @property int $id
 * @property int $company_id
 * @property string $photo
 *
 * @property Company $company
 */
class CompanySliderPhoto extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'company_slider_photo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['company_id'], 'integer'],
            [['photo'], 'string', 'max' => 500],
            [['company_id', 'photo'], 'required']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'company_id' => 'Company ID',
            'photo' => 'Photo',
        ];
    }

    public function getCompany()
    {
        return $this->hasOne(Company::className(), ['id' => 'company_id']);
    }
}
