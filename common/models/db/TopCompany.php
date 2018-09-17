<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "top_company".
 *
 * @property integer $id
 * @property integer $company_id
 * @property integer $order
 */
class TopCompany extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'top_company';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['company_id', 'order'], 'integer'],
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
            'order' => 'Order',
        ];
    }

    public function getcompany(){
        return $this->hasOne(Company::className(), ['id'=>'company_id']);
    }
}
