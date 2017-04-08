<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "site_addable_meta".
 *
 * @property integer $id
 * @property integer $site_params_id
 */
class SiteAddableMeta extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'site_addable_meta';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['site_params_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('site', 'ID'),
            'site_params_id' => Yii::t('site', 'Site Params ID'),
        ];
    }
}
