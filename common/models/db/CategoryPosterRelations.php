<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "category_poster_relations".
 *
 * @property integer $id
 * @property integer $cat_id
 * @property integer $poster_id
 */
class CategoryPosterRelations extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'category_poster_relations';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cat_id', 'poster_id'], 'integer'],
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
            'poster_id' => 'Poster ID',
        ];
    }

    public function getcategory_poster(){
        return $this->hasOne(CategoryPoster::className(), ['id'=>'cat_id']);
    }
}
