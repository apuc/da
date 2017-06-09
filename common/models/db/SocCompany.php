<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "soc_company".
 *
 * @property integer $id
 * @property integer $company_id
 * @property string $link
 * @property integer $soc_type
 *
 * @property SocAvailable $socType
 * @property Company $company
 */
class SocCompany extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'soc_company';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['company_id'], 'required'],
            [['company_id', 'soc_type'], 'integer'],
            [['link'], 'string', 'max' => 255],
            //[['soc_type'], 'exist', 'skipOnError' => true, 'targetClass' => SocAvailable::className(), 'targetAttribute' => ['soc_type' => 'id']],
           // [['company_id'], 'exist', 'skipOnError' => true, 'targetClass' => Company::className(), 'targetAttribute' => ['company_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'company_id' => 'Название компании',
            'link' => 'Ссылка на соц. сеть',
            'soc_type' => 'Тип социальной сети',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSocType()
    {
        return $this->hasOne(SocAvailable::className(), ['id' => 'soc_type']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompany()
    {
        return $this->hasOne(Company::className(), ['id' => 'company_id']);
    }
}
