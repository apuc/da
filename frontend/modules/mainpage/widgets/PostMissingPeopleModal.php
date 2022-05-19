<?php

namespace frontend\modules\mainpage\widgets;

use common\models\db\GeobaseCity;

class PostMissingPeopleModal extends \yii\base\Widget
{
    public function run()
    {
        $cities = GeobaseCity::find()->orderBy('name')->all();

        return $this->render('search-people-modal-form', [
            'cities' => $cities
        ]);
    }
}