<?php
/**
 * Created by PhpStorm.
 * User: apuc0
 * Date: 19.09.2016
 * Time: 14:28
 */

namespace frontend\widgets;


use common\classes\Debug;
use common\classes\UserFunction;
use Yii;
use yii\base\Widget;
use yii\helpers\Url;
use yii\widgets\Menu;

class MainMenu extends Widget
{

    public function run()
    {
        return $this->render('mainmenu');
    }

}