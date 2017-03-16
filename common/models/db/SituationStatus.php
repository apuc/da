<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "situation_status".
 *
 * @property integer $id
 * @property string $name
 * @property string $circle
 * @property string $border
 */
class SituationStatus extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'situation_status';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'circle', 'border'], 'required'],
            [['name', 'circle', 'border'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Имя',
            'circle' => 'Круг',
            'border' => 'Рамка',
        ];
    }

    public function getsituation(){
        return $this->hasMany(Situation::className(),['situation_status_id'=>'id']);
    }
}
