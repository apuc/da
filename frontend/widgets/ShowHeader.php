<?php
/**
 * Created by PhpStorm.
 * User: apuc0
 * Date: 15.04.2017
 * Time: 15:57
 */

namespace frontend\widgets;

use common\classes\Debug;
use common\classes\GeobaseFunction;
use common\classes\UserFunction;
use yii\base\Widget;

class ShowHeader extends Widget
{
    public function run()
    {
        $userRegion = UserFunction::getRegionUser();
        $regionList = GeobaseFunction::getListRegion();

        return $this->render('header',
            [
                'regionList' => $regionList,
                'userRegion' => $userRegion,
            ]
        );
    }
}