<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "site_error".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $url
 * @property string $msg
 */
class SiteError extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'site_error';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id'], 'integer'],
            [['url'], 'required'],
            [['msg'], 'string'],
            [['url'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'url' => 'Url',
            'msg' => 'Msg',
        ];
    }
}
