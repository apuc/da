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
            /*->where(['>','dt_add',84600 * 30])*/
            ->orderBy('views DESC')
            ->limit(12)
            ->all();
        return $this->render('company_main', ['companies'=>$companies]);
    }

}