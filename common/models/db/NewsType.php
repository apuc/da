<?php

namespace common\models\db;

/**
 * @property integer $id
 * @property string $label
 */
class NewsType extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'news_type';
    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['label'], 'string', 'max' => 32],
        ];
    }


    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fio' => 'Название типа',
        ];
    }

    /**
     * @param $id
     * @return static
     */
    public static function findById($id)
    {
        return static::findOne(['id' => $id]);
    }

}