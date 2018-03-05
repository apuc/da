<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "tw_pages".
 *
 * @property int $id
 * @property string $title
 * @property int $tw_id
 * @property string $screen_name
 * @property string $icon
 * @property int $status
 */
class TwPages extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tw_pages';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tw_id', 'status'], 'integer'],
            [['screen_name'], 'required'],
            [['title', 'screen_name', 'icon'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Название',
            'tw_id' => 'Tw ID',
            'screen_name' => 'Screen Name',
            'icon' => 'Иконка',
            'status' => 'Статус',
        ];
    }
}
