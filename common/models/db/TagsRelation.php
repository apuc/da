<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "tags_relation".
 *
 * @property integer $id
 * @property string $type
 * @property integer $post_id
 * @property integer $tag_id
 */
class TagsRelation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tags_relation';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['post_id', 'tag_id'], 'integer'],
            [['type'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type' => 'Type',
            'post_id' => 'Post ID',
            'tag_id' => 'Tag ID',
        ];
    }

    public function getNews()
    {
        return $this->hasOne(\frontend\modules\news\models\News::className(), ['id' => 'post_id']);
    }

    public function getTags()
    {
        return $this->hasOne(Tags::className(), ['id' => 'tag_id']);
    }


}
