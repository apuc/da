<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "site_params".
 *
 * @property integer $id
 * @property string $meta_key
 * @property string $meta_value
 * @property string $site
 */
class SiteParams extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'site_params';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['meta_key', 'site'], 'string', 'max' => 64],
            [['meta_value'], 'string', 'max' => 512],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('site', 'ID'),
            'meta_key' => Yii::t('site', 'Meta Key'),
            'meta_value' => Yii::t('site', 'Meta Value'),
            'site' => Yii::t('site', 'Site'),
        ];
    }
}
