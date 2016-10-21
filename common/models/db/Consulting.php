<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "consulting".
 *
 * @property integer $id
 * @property string $title
 * @property string $descr
 * @property integer $dt_add
 * @property integer $dt_update
 * @property string $slug
 * @property string $icon
 * @property integer $views
 * @property integer $company_id
 */
class Consulting extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'consulting';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['descr'], 'string'],
            [['dt_add', 'dt_update', 'views', 'company_id'], 'integer'],
            [['title', 'slug', 'icon'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('consulting', 'ID'),
            'title' => Yii::t('consulting', 'Title'),
            'descr' => Yii::t('consulting', 'Descr'),
            'dt_add' => Yii::t('consulting', 'Dt Add'),
            'dt_update' => Yii::t('consulting', 'Dt Update'),
            'slug' => Yii::t('consulting', 'Slug'),
            'icon' => Yii::t('consulting', 'Icon'),
            'views' => Yii::t('consulting', 'Views'),
            'company_id' => Yii::t('consulting', 'Company ID'),
        ];
    }
}
