<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "soc_available".
 *
 * @property integer $id
 * @property string $name
 * @property string $icon
 *
 * @property SocCompany[] $socCompanies
 */
class SocAvailable extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'soc_available';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
//            [['name', 'icon'], 'required'],
            [['name', 'icon'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Имя соц. сети',
            'icon' => 'Иконка соц. сети',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSocCompanies()
    {
        return $this->hasMany(SocCompany::className(), ['soc_type' => 'id']);
    }

    /**
     * @return array
     */
    public static function getIds()
    {
        return self::find()->select('id')->column();
    }
}
