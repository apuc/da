<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "situation".
 *
 * @property integer $id
 * @property string $name
 * @property string $report_time
 * @property string $descr
 * @property string $link
 * @property integer $situation_status_id
 */
class Situation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'situation';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['descr'], 'string'],
            [['situation_status_id'], 'integer'],
            [['name', 'report_time', 'link'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название пункта пропуска',
            'report_time' => 'Report Time',
            'descr' => 'Описание',
            'situation_status_id' => 'Статус',
            'link' => 'Ссылка',
        ];
    }

    public function getStatus()
    {
        return $this->hasOne(SituationStatus::className(), ['id' => 'situation_status_id']);
    }
}
