<?php
/**
 * Created by PhpStorm.
 * User: apuc0
 * Date: 04.10.2016
 * Time: 15:33
 */

namespace frontend\modules\news\widgets;


use Yii;
use yii\base\Widget;

class NewsArchive extends Widget
{

    public function run()
    {
        if (Yii::$app->controller->module->id == 'news') {
            return $this->render("news_archive");
        }
        return false;
    }

}