<?php

namespace common\models\db;

use common\models\User;
use Yii;

/**
 * This is the model class for table "stock_comments".
 *
 * @property int $id
 * @property int $stock_id
 * @property int $user_id
 * @property string $content
 * @property int $dt_add
 * @property int $parent_id
 * @property int $moder_checked
 * @property int $published
 * @property int $verified
 */
class StockComments extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'stock_comments';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['stock_id', 'user_id', 'dt_add', 'parent_id', 'moder_checked', 'published', 'verified'], 'integer'],
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
            'stock_id' => Yii::t('comments', 'Stock ID'),
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
    public function getStock()
    {
        return $this->hasOne(Stock::className(), ['id' => 'stock_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
