<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "people_talk".
 *
 * @property integer $id
 * @property string $nickname
 * @property string $title
 * @property integer $rating
 * @property string $photo
 */
class PeopleTalk extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'people_talk';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nickname', 'title'], 'required'],
            [['rating'], 'integer'],
            [['nickname'], 'string', 'max' => 128],
            [['title','photo'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('talk', 'ID'),
            'nickname' => Yii::t('talk', 'Nickname'),
            'title' => Yii::t('talk', 'Title'),
            'rating' => Yii::t('talk', 'Rating'),
            'photo' => Yii::t('talk', 'Photo'),
        ];
    }
}
