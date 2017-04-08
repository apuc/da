<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "category_posts_digest_relations".
 *
 * @property integer $id
 * @property integer $cat_id
 * @property integer $posts_digest_id
 */
class CategoryPostsDigestRelations extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'category_posts_digest_relations';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cat_id', 'posts_digest_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('poster', 'ID'),
            'cat_id' => Yii::t('poster', 'Cat ID'),
            'posts_digest_id' => Yii::t('poster', 'Posts Digest ID'),
        ];
    }
}
