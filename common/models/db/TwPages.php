<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "tw_pages".
 *
 * @property int $id
 * @property string $title
 * @property string $tw_id
 * @property string $screen_name
 * @property string $icon
 * @property string $status
 * 
 * @property array $statuses
 * @property string $statusText
 */
class TwPages extends \yii\db\ActiveRecord
{
	const STATUS_INACTIVE = 0;
	const STATUS_ACTIVE = 1;

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
	        [['tw_id'], 'string', 'max' => 32],
	        [['status'], 'integer'],
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

    public function getStatusText()
    {
    	return $this->statuses[$this->status];
    }

    public function getStatuses()
    {
    	return [
    		self::STATUS_INACTIVE => 'Не активна',
		    self::STATUS_ACTIVE => 'Активна',
	    ];
    }
}
