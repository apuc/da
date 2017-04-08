<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "site_meta_params".
 *
 * @property integer $id
 * @property integer $site_addable_meta_id
 * @property string $key
 * @property string $value
 */
class SiteMetaParams extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'site_meta_params';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['site_addable_meta_id'], 'integer'],
            [['value'], 'string'],
            [['key'], 'string', 'max' => 64],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('site', 'ID'),
            'site_addable_meta_id' => Yii::t('site', 'Site Addable Meta ID'),
            'key' => Yii::t('site', 'Key'),
            'value' => Yii::t('site', 'Value'),
        ];
    }
}
