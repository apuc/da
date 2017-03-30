<?php
/**
 * Created by PhpStorm.
 * User: apuc0
 * Date: 04.10.2016
 * Time: 15:33
 */

namespace frontend\modules\news\widgets;

use common\classes\Debug;
use common\models\db\News;
use Yii;
use yii\base\Widget;

class RubricSlider extends Widget
{
    public $categoryId;

    public function run()
    {


        return $this->render("rubric_slider", [

        ]);

    }

}