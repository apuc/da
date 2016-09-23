<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "category_news_relations".
 *
 * @property integer $id
 * @property integer $cat_id
 * @property integer $new_id
 *
 * @property News $new
 * @property CategoryNews $cat
 */
class CategoryNewsRelations extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'category_news_relations';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cat_id', 'new_id'], 'integer'],
            [['new_id'], 'exist', 'skipOnError' => true, 'targetClass' => News::className(), 'targetAttribute' => ['new_id' => 'id']],
            [['cat_id'], 'exist', 'skipOnError' => true, 'targetClass' => CategoryNews::className(), 'targetAttribute' => ['cat_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cat_id' => 'Cat ID',
            'new_id' => 'New ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNew()
    {
        return $this->hasOne(News::className(), ['id' => 'new_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCat()
    {
        return $this->hasOne(CategoryNews::className(), ['id' => 'cat_id']);
    }
}
