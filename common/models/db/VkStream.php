<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "vk_stream".
 *
 * @property integer $id
 * @property string $vk_id
 * @property integer $from_id
 * @property integer $owner_id
 * @property integer $owner_type
 * @property integer $dt_add
 * @property string $post_type
 * @property string $text
 * @property integer $from_type
 */
class VkStream extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'vk_stream';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['vk_id'], 'required'],
            [['from_id', 'owner_id', 'owner_type', 'dt_add', 'from_type'], 'integer'],
            [['text'], 'string'],
            [['vk_id', 'post_type'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'vk_id' => 'Vk ID',
            'from_id' => 'From ID',
            'owner_id' => 'Owner ID',
            'owner_type' => 'Owner Type',
            'dt_add' => 'Dt Add',
            'post_type' => 'Post Type',
            'text' => 'Text',
            'from_type' => 'From Type',
        ];
    }
}
