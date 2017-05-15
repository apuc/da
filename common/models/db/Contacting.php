<?php

namespace common\models\db;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "contacting".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $type
 * @property string $content
 * @property integer $dt_add
 * @property integer $dt_update
 */
class Contacting extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'contacting';
    }

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['dt_add', 'dt_update'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['dt_update'],
                ],
            ],
        ];
    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'dt_add', 'dt_update'], 'integer'],
            [['type', 'content'], 'required'],
            [['type'], 'string', 'max' => 32],
            [['content'], 'string', 'max' => 1000],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('contacting', 'ID'),
            'user_id' => Yii::t('contacting', 'User ID'),
            'type' => Yii::t('contacting', 'Type'),
            'content' => Yii::t('contacting', 'Content'),
            'dt_add' => Yii::t('contacting', 'Dt Add'),
            'dt_update' => Yii::t('contacting', 'Dt Update'),
        ];
    }
}
