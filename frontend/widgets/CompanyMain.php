<?php
/**
 * Created by PhpStorm.
 * User: apuc0
 * Date: 16.03.2017
 * Time: 16:28
 */

namespace frontend\widgets;

use common\classes\Debug;
use common\models\db\Company;
use yii\base\Widget;

class CompanyMain extends Widget
{

    public function run()
    {
        $companies = Company::find()
            ->where(['status' => 0, 'main' => 1])
            //->orderBy('views DESC')
            ->orderBy('RAND()')
            ->limit(12)
            ->all();
        return $this->render('company_main', ['companies'=>$companies]);
    }

}