<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "category_faq_relations".
 *
 * @property integer $id
 * @property integer $cat_id
 * @property integer $faq_id
 */
class CategoryFaqRelations extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'category_faq_relations';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cat_id', 'faq_id'], 'integer'],
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
            'faq_id' => 'Faq ID',
        ];
    }
}
