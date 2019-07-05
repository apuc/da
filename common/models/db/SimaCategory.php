<?php

namespace common\models\db;

class SimaCategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sima_categories';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
          [['id', 'sima_id','sid', 'priority','priority_home', 'priority_menu', 'is_hidden_in_menu',
              'level' , 'type', 'is_adult', 'category_group_id', 'is_leaf',],'integer'],
            [['name', 'path', 'photo', 'icon', 'full_slug' , 'full_slug' , 'h2_title'], 'string'],
            [['has_loco_slider', 'has_design', 'has_as_main_design', 'is_item_description_hidden', 'is_for_mobile_app'],'boolean']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {

    }
}