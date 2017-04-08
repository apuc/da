<?php
/**
 * Created by PhpStorm.
 * User: apuc0
 * Date: 26.09.2016
 * Time: 20:59
 */

namespace frontend\modules\poster\widgets;

use common\models\db\CategoryPoster;
use yii\base\Widget;

class Categories extends Widget
{

    public function run()
    {

        $categories = CategoryPoster::find()->orderBy('RAND()')->limit(5)->all();

        return $this->render('categories', [
            'categories' => $categories,
        ]);
    }

}