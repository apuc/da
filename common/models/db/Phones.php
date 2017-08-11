<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "phones".
 *
 * @property integer $id
 * @property string $phone
 * @property integer $company_id
 */
class Phones extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'phones';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['company_id'], 'integer'],
            [['phone'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'phone' => 'Phone',
            'company_id' => 'Company ID',
        ];
    }
}
