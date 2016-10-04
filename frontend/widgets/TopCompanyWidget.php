<?php
/**
 * Created by PhpStorm.
 * User: apuc0
 * Date: 29.09.2016
 * Time: 16:26
 */

namespace frontend\widgets;


use common\classes\Debug;
use common\models\db\TopCompany;
use yii\base\Widget;

class TopCompanyWidget extends Widget
{

    public function run()
    {
        $top_company = TopCompany::find()
            ->leftJoin('company', '`top_company`.`company_id` = `company`.`id`')
            ->orderBy('order DESC')
            ->with('company')
            ->all();

        return $this->render('top_company', [
            'top_company' => $top_company
        ]);
    }

}