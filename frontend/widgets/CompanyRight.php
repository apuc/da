<?php

namespace frontend\widgets;

use common\models\db\Company;
use yii\base\Widget;

class CompanyRight extends Widget
{
    public function run()
    {
        $companies = Company::find()
            ->where(['status' => 0, 'recommended' => 1])
            ->orderBy('RAND()')
            ->limit(4)
            ->all();
        return $this->render('company_right', ['companies' => $companies]);
    }
}