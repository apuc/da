<?php
/**
 * Created by PhpStorm.
 * User: apuc0
 * Date: 18.04.2017
 * Time: 16:01
 */

namespace frontend\modules\company\widgets;

use common\classes\Debug;
use common\models\db\CategoryCompany;
use yii\base\Widget;
use yii\helpers\ArrayHelper;

class CategoryMenu extends Widget
{

    public function run()
    {
        $company = CategoryCompany::find()->where(['parent_id' => 0, 'lang_id' => 1])->all();
        $sub_company = CategoryCompany::find()
            ->where(['parent_id' => ArrayHelper::getColumn($company,'id')])
            ->all();
        $sub_category_by_parent = [];
        foreach ($sub_company as $item){
            $sub_category_by_parent[$item->parent_id][] = [
                'id' => $item->id,
                'title' => $item->title,
                'slug' => $item->slug,
            ];
        }
        $parent_category = array_chunk($company, count($company) / 2);
        return $this->render('category_menu', [
            'parent_category' => $parent_category,
            'sub_category_by_parent' => $sub_category_by_parent,
        ]);
    }

}