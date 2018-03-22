<?php
/**
 * Created by PhpStorm.
 * User: king
 * Date: 30.01.18
 * Time: 14:28
 */

namespace frontend\modules\shop\widgets;

use frontend\modules\shop\models\CategoryShop;
use yii\base\Widget;

class ShowTopTools extends Widget
{
    public function run()
    {
        $category = CategoryShop::find()->where(['parent_id' => 0])->all();
        return $this->render('top-tools',
            [
                'category' => $category,
            ]);
    }
}