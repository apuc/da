<?php

namespace frontend\modules\mainpage\widgets;

use common\models\db\GeobaseCity;
use Gregwar\Captcha\CaptchaBuilder;

class PostMissingPeopleModal extends \yii\base\Widget
{
    public function run()
    {
        $cities = GeobaseCity::find()->orderBy('name')->all();
        $builder = new CaptchaBuilder();
        $builder->build();

        return $this->render('search-people-modal-form', [
            'cities' => $cities,
            'captchaBuilder' => $builder
        ]);
    }
}