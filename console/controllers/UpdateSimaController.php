<?php

namespace console\controllers;

use backend\modules\sima_land\components\SimaLand;
use common\models\db\SimaCategory;
use yii\console\Controller;

class UpdateSimaController extends Controller
{
    public function actionIndex()
    {
        SimaCategory::deleteAll();
        $response = SimaLand::load();
        $count = $response['_meta']['pageCount'];
        for($i = 0; $i<$count;++$i)
        {
            $response = SimaLand::load($i);
            foreach ($response['items'] as $item)
            {
                $tmp = new SimaCategory();
                $tmp->sima_id = $item['id'];
                $tmp->sid = $item['sid'];
                $tmp->name = $item['name'];
                $tmp->priority = $item['priority'];
                $tmp->priority_home = $item['priority_home'];
                $tmp->priority_menu = $item['priority_menu'];
                $tmp->is_hidden_in_menu = $item['is_hidden_in_menu'];
                $tmp->path = $item['path'];
                $tmp->level = $item['level'];
                $tmp->type = $item['type'];
                $tmp->is_adult = $item['is_adult'];
                $tmp->has_loco_slider = $item['has_loco_slider'];
                $tmp->has_design = $item['has_design'];
                $tmp->has_as_main_design = $item['has_as_main_design'];
                $tmp->is_item_description_hidden = $item['is_item_description_hidden'];
                $tmp->is_for_mobile_app = $item['is_for_mobile_app'];
                $tmp->category_group_id = $item['category_group_id'];
                $tmp->photo = $item['photo'];
                $tmp->icon = $item['icon'];
                $tmp->is_leaf = $item['is_leaf'];
                $tmp->full_slug = $item['full_slug'];
                $tmp->upper_text = $item['upper_text'];
                $tmp->h2_title = $item['h2_title'];
                $tmp->save();
            }
        }
    }
}