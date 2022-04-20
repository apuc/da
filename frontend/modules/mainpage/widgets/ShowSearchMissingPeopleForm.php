<?php

namespace frontend\modules\mainpage\widgets;

use yii\base\Widget;

class ShowSearchMissingPeopleForm extends Widget
{
    public function run()
    {
       return $this->render('search-people-form', []);
    }
}