<?php

namespace common\models\db;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "pages_group".
 *
 * @property integer $id
 * @property string $title
 * @property string $slug
 * @property integer $dt_add
 * @property integer $dt_update
 */
class PagesGroup extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pages_group';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['dt_add', 'dt_update'], 'integer'],
            [['title', 'slug'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Заголовок',
            'slug' => 'Slug',
            'dt_add' => 'Дата добавления',
            'dt_update' => 'Дата редактирования',
        ];
    }

    public static function getList()
    {
        return ArrayHelper::map(self::find()->all(), 'id', 'title');
    }
}
