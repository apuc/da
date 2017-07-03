<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "services_company_relations".
 *
 * @property integer $services_id
 * @property integer $company_id
 *
 * @property Company $company
 * @property Services $services
 */
class ServicesCompanyRelations extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'services_company_relations';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['services_id', 'company_id'], 'integer'],
            [['company_id'], 'exist', 'skipOnError' => true, 'targetClass' => Company::className(), 'targetAttribute' => ['company_id' => 'id']],
            [['services_id'], 'exist', 'skipOnError' => true, 'targetClass' => Services::className(), 'targetAttribute' => ['services_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'services_id' => 'Services ID',
            'company_id' => 'Company ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompany()
    {
        return $this->hasOne(Company::className(), ['id' => 'company_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getServices()
    {
        return $this->hasOne(Services::className(), ['id' => 'services_id']);
    }
}
