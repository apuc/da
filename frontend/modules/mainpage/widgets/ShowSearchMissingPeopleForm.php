<?php

namespace frontend\modules\mainpage\widgets;

use common\models\db\GeobaseCity;
use yii\base\Widget;

class ShowSearchMissingPeopleForm extends Widget
{
    public function run()
    {
        $cities = GeobaseCity::find()->orderBy('name')->all();

       return $this->render('search-people-form', [
           'cities' => $cities
       ]);
    }
}