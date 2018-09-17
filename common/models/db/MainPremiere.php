<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "main_premiere".
 *
 * @property integer $id
 * @property string $description
 * @property integer $region_id
 * @property string $photo
 * @property integer $afisha_id
 */
class MainPremiere extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'main_premiere';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['description', 'afisha_id'], 'required'],
            [['region_id', 'afisha_id'], 'integer'],
            [['photo'], 'string'],
            [['description'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'description' => 'Description',
            'region_id' => 'Region ID',
            'photo' => 'Photo',
            'afisha_id' => 'Afisha ID',
        ];
    }
}
