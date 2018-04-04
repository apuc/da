<?php

namespace common\models\db;

use common\models\User;
use Yii;

/**
 * This is the model class for table "news_comments".
 *
 * @property int $id
 * @property int $news_id
 * @property int $user_id
 * @property string $content
 * @property int $dt_add
 * @property int $parent_id
 * @property int $moder_checked
 * @property int $published
 * @property int $verified
 */
class NewsComments extends \yii\db\ActiveRecord
{

    public $count;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'news_comments';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['news_id', 'user_id', 'dt_add', 'parent_id', 'moder_checked', 'published', 'verified'], 'integer'],
            [['content'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('comments', 'ID'),
            'news_id' => Yii::t('comments', 'News ID'),
            'user_id' => Yii::t('comments', 'User ID'),
            'content' => Yii::t('comments', 'Content'),
            'dt_add' => Yii::t('comments', 'Dt Add'),
            'parent_id' => Yii::t('comments', 'Parent ID'),
            'moder_checked' => Yii::t('comments', 'Moder Checked'),
            'published' => Yii::t('comments', 'Published'),
            'verified' => Yii::t('comments', 'Verified'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNews()
    {
        return $this->hasOne(News::className(), ['id' => 'news_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
