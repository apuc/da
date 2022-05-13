<?php

namespace frontend\modules\mainpage\widgets;

use common\models\db\GeobaseCity;

class ShowSearchMissingPeopleFormForIndex extends \yii\base\Widget
{
    public function run()
    {
        $cities = GeobaseCity::find()->orderBy('name')->all();

        return $this->render('search-people-form-index', [
            'cities' => $cities
        ]);
    }
}